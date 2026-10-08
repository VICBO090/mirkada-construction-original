namespace App\Mail;

use App\Models\RendezVous;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RendezVousMail extends Mailable
{
    use Queueable, SerializesModels;

    public RendezVous $rendezVous;

    public function __construct(RendezVous $rendezVous)
    {
        $this->rendezVous = $rendezVous;
    }

    public function build()
    {
        $subject = $this->rendezVous->statut === 'confirme'
            ? 'Votre rendez-vous est confirmé — Mirkada Construction'
            : 'Votre demande de rendez-vous a bien été reçue — Mirkada Construction';

        return $this->subject($subject)->view('emails.rendez-vous');
    }
}