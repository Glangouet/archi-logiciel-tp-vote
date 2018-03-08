<?php

/**
 * Class PromptService
 */
class PromptService
{
    /**
     * @param $nb
     * @return string
     */
    public function getLineReturn($nb)
    {
        $str = "";
        for ($i = 1; $i < $nb; $i++) {
            $str .= "\n";
        }

        return $str;
    }
}