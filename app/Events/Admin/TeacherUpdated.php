<?php

namespace App\Events\Admin;

use App\Models\Teacher;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// change in broadcastAs return value and potentially other functions,
// requires php artisan queue:restart
// or restart manually
class TeacherUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Teacher $teacher) {}

    // /**
    //  * Get the channels the event should broadcast on.
    //  *
    //  * @return array<int, \Illuminate\Broadcasting\Channel>
    //  */
    // public function broadcastOn(): array
    // {
    //     return [
    //         // new PrivateChannel("teachers.{$this->teacher->id}"),
    //         new PrivateChannel('teachers'),
    //     ];
    // }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel("teachers.{$this->teacher->id}");
    }

    public function broadcastAs(): string
    {
        return 'updated';
    }

    public function broadcastWith(): array
    {
        return [
            'payload' => [
                'message' => [
                    "teacher with name {$this->teacher->name} has been updated.",
                ],
            ],
        ];
    }
}
