 <?php


use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

// class UserTaskCreateNotification extends Notification
// {
//     use Queueable;

//     /**
//      * Create a new notification instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         //
//     }

//     /**
//      * Get the notification's delivery channels.
//      *
//      * @param  mixed  $notifiable
//      * @return array
//      */
//     public function via($notifiable)
//     {
//         return ['database'];
//     }


//     /**
//      * Get the array representation of the notification.
//      *
//      * @param  mixed  $notifiable
//      * @return array
//      */
//     public function toArray($notifiable)
//     {
//         return [
//             'message' => 'A new task has been created by a user',
//         ];
//     }
// }
