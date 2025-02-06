<?php

namespace app\modules\control\commands\Game;

use AllowDynamicProperties;

#[AllowDynamicProperties]
class Config
{
    private bool $isEnabled = false;
    private string $version = '';

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(bool $isEnabled): void
    {
        $this->isEnabled = $isEnabled;
    }

    public function toString()
    {
        return sprintf(
            "Enabled: %s\nVersion: %s",
            $this->isEnabled ? 'Включен' : 'Выключен',
            $this->version
        );
    }
}