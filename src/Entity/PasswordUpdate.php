<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;


class PasswordUpdate
{


    private $oldPassword;
    /**
     * @Assert\Length(min = 8 , minMessage ="Votre mot de passe doit faire au moins 8 caractéres")
     */
    private $newPassword;
    /**
     * @Assert\Length(min = 8 , minMessage ="Votre mot de passe doit faire au moins 8 caractéres")
     */
    
    private $ConfirmPassword;
    /**
     * @Assert\EqualTo( propertyPath="newPassword" , message ="Confirmé votre nouveau mot de passe")
     * 
     */
    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function setOldPassword(string $oldPassword): self
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->ConfirmPassword;
    }

    public function setConfirmPassword(string $ConfirmPassword): self
    {
        $this->ConfirmPassword = $ConfirmPassword;

        return $this;
    }
}
