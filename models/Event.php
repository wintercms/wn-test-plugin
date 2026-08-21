<?php namespace Winter\Test\Models;

use Model;
use Carbon\Carbon;

/**
 * Event Model - fixture for exercising the Backend\Behaviors\CalendarController behavior.
 *
 * Supports a minimal recurrence rule (the `rrule` column) so the calendar's server-side
 * recurrence expansion pattern can be demonstrated and tested end to end.
 */
class Event extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_events';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Attributes cast to native/Carbon types.
     */
    protected $casts = [
        'all_day' => 'boolean',
    ];

    /**
     * @var array Date attributes (cast to Carbon).
     */
    public $dates = ['start_at', 'end_at'];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'start_at' => 'required',
    ];

    /**
     * Whether this event carries a recurrence rule.
     */
    public function isRecurring(): bool
    {
        return !empty($this->rrule);
    }

    /**
     * Expands a recurring master into concrete occurrence models that intersect the given
     * window. Non-recurring events return themselves. Supports a minimal RRULE subset:
     * FREQ=DAILY|WEEKLY|MONTHLY, plus INTERVAL, COUNT and UNTIL.
     *
     * @return static[]
     */
    public function expandOccurrences(Carbon $windowStart, Carbon $windowEnd): array
    {
        if (!$this->isRecurring() || empty($this->start_at)) {
            return [$this];
        }

        $rule = $this->parseRrule($this->rrule);
        $freq = $rule['FREQ'] ?? null;
        if (!in_array($freq, ['DAILY', 'WEEKLY', 'MONTHLY'], true)) {
            return [$this];
        }

        $interval = max(1, (int) ($rule['INTERVAL'] ?? 1));
        $count = isset($rule['COUNT']) ? (int) $rule['COUNT'] : null;
        $until = isset($rule['UNTIL']) ? Carbon::parse($rule['UNTIL']) : null;

        $duration = $this->end_at ? $this->start_at->diffInSeconds($this->end_at) : 0;

        $occurrences = [];
        $cursor = $this->start_at->copy();

        for ($i = 0; $i < 1000; $i++) {
            if ($count !== null && $i >= $count) {
                break;
            }
            // Compare by day so a date-only UNTIL (e.g. 2026-08-15) includes that whole day.
            if ($until !== null && $cursor->copy()->startOfDay()->greaterThan($until->copy()->startOfDay())) {
                break;
            }
            if ($cursor->greaterThanOrEqualTo($windowEnd)) {
                break;
            }

            $occurrenceEnd = $cursor->copy()->addSeconds($duration);

            // Keep occurrences that intersect the window (end >= windowStart, start < windowEnd).
            if ($occurrenceEnd->greaterThanOrEqualTo($windowStart)) {
                $occurrence = $this->replicate();
                $occurrence->setAttribute($this->getKeyName(), $this->getKey());
                $occurrence->exists = true;
                $occurrence->start_at = $cursor->copy();
                $occurrence->end_at = $duration ? $occurrenceEnd : null;
                $occurrences[] = $occurrence;
            }

            switch ($freq) {
                case 'DAILY':
                    $cursor->addDays($interval);
                    break;
                case 'WEEKLY':
                    $cursor->addWeeks($interval);
                    break;
                case 'MONTHLY':
                    $cursor->addMonths($interval);
                    break;
            }
        }

        return $occurrences;
    }

    /**
     * Parses an RRULE string (e.g. "FREQ=WEEKLY;INTERVAL=2;COUNT=10") into a key => value map.
     */
    protected function parseRrule(string $rrule): array
    {
        $parts = [];
        foreach (explode(';', $rrule) as $segment) {
            if (strpos($segment, '=') === false) {
                continue;
            }
            [$key, $value] = explode('=', $segment, 2);
            $parts[strtoupper(trim($key))] = trim($value);
        }
        return $parts;
    }
}
