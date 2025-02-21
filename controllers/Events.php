<?php namespace Winter\Test\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use Carbon\CarbonImmutable;
use Winter\Storm\Support\Facades\DB;
use Winter\Storm\Support\Facades\Flash;
use Winter\Test\Models\Event;

/**
 * Events Backend Controller
 */
class Events extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\CalendarController::class,
    ];

    /**
     * @var array Permissions required to view this page.
     */
    protected $requiredPermissions = [
        'winter.test.events.manage_all',
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Winter.Test', 'test', 'events');

        if ($this->action == 'calendar') {
            BackendMenu::setContext('Winter.Test', 'test', 'calendar');
        }
    }


    public function onSeed()
    {
        $eventModel = (new Event);
        $now = CarbonImmutable::now()->startOfMonth();

        DB::table($eventModel->table)->truncate();

        // Generate 10 events from now to 60 days
        for ($i=1; $i <= 10; $i++) {
            $start = rand(0, 60);
            $duration = rand(0, 2);
            $allDay = rand(0, 1) == 1;

            if ($allDay) {
                $startHour = 0;
                $endHour = 23;
            } else {
                $startHour = rand(8, 14);
                $endHour = rand($startHour, 23);
                $startHour = $startHour < 10 ? '0' . $startHour : $startHour;
                $endHour = $endHour < 10 ? '0' . $endHour : $endHour;
            }

            $event = [
                'name' => 'Event #' . $i,
                'start_at' => $now->addDays($start)
                    ->setHours($startHour)
                    ->setMinutes(0)
                    ->setSeconds(0)
                    ->format('Y-m-d H:i:s'),
                'end_at' => $now->addDays($start + $duration)
                    ->setHours($endHour)
                    ->setMinutes(0)
                    ->setSeconds(0)
                    ->format('Y-m-d H:i:s'),
                'is_allday' => $allDay,
            ];
            $eventModel->create($event);
        }

        if ($this->action == 'index') {
            Flash::success('New events have been successfully seeded!');
            return $this->listRefresh();
        } elseif ($this->action == 'calendar') {
            Flash::info('New events have been successfully seeded! Please refresh this page to load new events;');
        }
    }
}
