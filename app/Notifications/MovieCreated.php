<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Movie;

class MovieCreated extends Notification
{
    use Queueable;

    protected $movie;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('A movie has been updated !')
                    ->line('Movie: ' . $this->movie->title)
                    ->line('Year: ' . $this->movie->year)
                    ->line('Creation date: ' . $this->movie->created_at)
                    ->action('View the movie', route('movie.edit', $this->movie->id))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'A movie has been updated !',
            'link' => route('movie.edit', $this->movie->id),
        ];
    }
}
