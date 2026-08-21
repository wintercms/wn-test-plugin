<?php

namespace Winter\Test\Tests;

use Backend\Widgets\Calendar as CalendarWidget;
use Carbon\Carbon;
use System\Tests\Bootstrap\PluginTestCase;
use Winter\Storm\Database\Model;
use Winter\Test\Models\Event;

/**
 * Exercises the Event model's recurrence expansion and the CalendarController behavior's
 * server-side recurrence pattern wired up in Winter\Test\Plugin::boot().
 *
 * @covers \Winter\Test\Models\Event
 */
class EventCalendarTest extends PluginTestCase
{
    protected int $windowStart;
    protected int $windowEnd;

    public function setUp(): void
    {
        parent::setUp();

        // The events table is created by the plugin migration during winter:up.
        $this->windowStart = Carbon::parse('2026-08-01 00:00:00', 'UTC')->timestamp;
        $this->windowEnd = Carbon::parse('2026-09-01 00:00:00', 'UTC')->timestamp;
    }

    protected function seedEvent(string $name, string $start, ?string $end = null, array $attributes = []): Event
    {
        Model::unguard();
        $event = Event::create(array_merge([
            'name' => $name,
            'start_at' => $start,
            'end_at' => $end,
            'all_day' => false,
        ], $attributes));
        Model::reguard();

        return $event;
    }

    protected function makeCalendarWidget(): CalendarWidget
    {
        $widget = new CalendarWidget(null, [
            'alias' => 'calendar',
            'recordTitle' => 'name',
            'recordStart' => 'start_at',
            'recordEnd' => 'end_at',
            'recordAllDay' => 'all_day',
        ]);
        $widget->model = new Event;

        return $widget;
    }

    public function testExpandsWeeklyRecurrenceIntoTheWindow()
    {
        // Master starts well before the window (2026-06-01 is a Monday).
        $event = $this->seedEvent('Standup', '2026-06-01 09:00:00', '2026-06-01 09:30:00', ['rrule' => 'FREQ=WEEKLY']);

        $occurrences = $event->expandOccurrences(
            Carbon::createFromTimestamp($this->windowStart, 'UTC'),
            Carbon::createFromTimestamp($this->windowEnd, 'UTC')
        );

        // Mondays in August 2026: 3rd, 10th, 17th, 24th, 31st.
        $this->assertCount(5, $occurrences);
        foreach ($occurrences as $occurrence) {
            $this->assertGreaterThanOrEqual($this->windowStart, $occurrence->start_at->timestamp);
            $this->assertLessThan($this->windowEnd, $occurrence->start_at->timestamp);
            // Occurrences keep the master's key so recordUrl still resolves.
            $this->assertSame($event->getKey(), $occurrence->getKey());
        }
    }

    public function testExpandsMonthlyRecurrenceRespectingCount()
    {
        $event = $this->seedEvent('Review', '2026-08-15 14:00:00', '2026-08-15 15:00:00', ['rrule' => 'FREQ=MONTHLY;COUNT=3']);

        $occurrences = $event->expandOccurrences(
            Carbon::parse('2026-08-01', 'UTC'),
            Carbon::parse('2027-01-01', 'UTC')
        );

        // Aug 15, Sep 15, Oct 15.
        $this->assertCount(3, $occurrences);
        $this->assertSame('2026-08-15', $occurrences[0]->start_at->format('Y-m-d'));
        $this->assertSame('2026-10-15', $occurrences[2]->start_at->format('Y-m-d'));
    }

    public function testRecurrenceRespectsUntil()
    {
        $event = $this->seedEvent('Weekly', '2026-08-01 09:00:00', '2026-08-01 10:00:00', ['rrule' => 'FREQ=WEEKLY;UNTIL=2026-08-15']);

        $occurrences = $event->expandOccurrences(
            Carbon::parse('2026-08-01', 'UTC'),
            Carbon::parse('2026-12-01', 'UTC')
        );

        // Aug 1, 8, 15 (UNTIL inclusive).
        $this->assertCount(3, $occurrences);
    }

    public function testNonRecurringEventReturnsItself()
    {
        $event = $this->seedEvent('One-off', '2026-08-21 13:00:00', '2026-08-21 14:00:00');

        $occurrences = $event->expandOccurrences(
            Carbon::parse('2026-08-01', 'UTC'),
            Carbon::parse('2026-09-01', 'UTC')
        );

        $this->assertCount(1, $occurrences);
        $this->assertSame($event, $occurrences[0]);
    }

    public function testCalendarWidgetExpandsRecurringMastersServerSide()
    {
        // Recurring master outside the window, plus a plain event inside it.
        $this->seedEvent('Standup', '2026-06-01 09:00:00', '2026-06-01 09:30:00', ['rrule' => 'FREQ=WEEKLY']);
        $this->seedEvent('Launch', '2026-08-25 10:00:00', '2026-08-25 12:00:00');

        // The plugin's boot() registers the recurrence listeners globally, so getRecords()
        // expands the master into August occurrences instead of dropping it.
        $result = $this->makeCalendarWidget()->getRecords($this->windowStart, $this->windowEnd);

        $titles = array_map(fn ($event) => $event['title'], $result['events']);
        $standups = array_filter($titles, fn ($title) => $title === 'Standup');

        $this->assertContains('Launch', $titles);
        $this->assertCount(5, $standups);

        // Every returned event falls within the visible window.
        foreach ($result['events'] as $event) {
            $start = Carbon::parse($event['start'])->timestamp;
            $this->assertGreaterThanOrEqual($this->windowStart, $start);
            $this->assertLessThan($this->windowEnd, $start);
        }
    }
}
