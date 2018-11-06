<?php


namespace App\Payloads;


class BitbucketPayload extends Payload
{

    public function getRepository(): string
    {
        return array_get($this->data, "repository.full_name");
    }

    public function getBranch(): string
    {
        return array_get($this->getLastBranchChange(), "new.name");
    }

    private function getLastBranchChange(): array
    {
        // We get the changes
        $changes = array_get($this->data, "push.changes");

        // We take only changes that can justify a deployement
        return array_first(
            $changes,
            function ($change) {

                return !$change["deleted"] && !$change["closed"]
                    && $change["new"]["type"] === "branch";

            });
    }

    public function isRelevent(): bool
    {
        // If the payload does not include a branch change
        if (empty($this->getLastBranchChange()))
            return false;

        return true;
    }
}