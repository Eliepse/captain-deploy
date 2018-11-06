<?php


namespace App\Payloads;


class GithubPayload extends Payload
{
    public function getRepository(): string
    {
        return array_get($this->data, "repository.full_name");
    }

    public function getBranch(): string
    {
        return basename(array_get($this->data, "ref"));
    }

    public function isRelevent(): bool
    {
        return !$this->data["deleted"] && !$this->data["closed"];
    }
}