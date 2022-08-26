<?php



namespace App\Extensions\Twig;



use App\AccessChecker;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AuthExtension extends AbstractExtension
{
    private AccessChecker $logon;

    public function __construct(AccessChecker $logon)
    {
        $this->logon = $logon;
    }

    public function getAccess(): array
    {
        return [
            new TwigFunction('user_access', [$this, 'checkUserAccess']),
        ];
    }

    public function checkUserAccess(...$roles): bool
    {
        return $this->logon->user_access(...$roles);
    }

}