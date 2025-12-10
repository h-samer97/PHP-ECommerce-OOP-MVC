<?php

    namespace Core\Interfaces;

    interface ISessions {

        public function start(): bool;
        public function set(string $key, string $value): bool;
        public function get(string $key) : mixed;
        public function has(string $key): bool;
        public function remove(string $key): void;
        public function destroy(): bool;

        // public function regenerateId(bool $deleteOld = true): void;
        // public function setFlash(string $key, string $message): void;
        // public function getFlash(string $key): ?string;

        // public function all(): array;
        // public function clear(): void;
}

?>