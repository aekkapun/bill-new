<?php
/**
 *
 */
interface AdapterInterface
{
    const PROCESS_STATUS_OK = 1;
    const PROCESS_STATUS_FAIL = 0;

    public function getName();

    public function getForm();

    public function process();

    public function commit($result);
}
