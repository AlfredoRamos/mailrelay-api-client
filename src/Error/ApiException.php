<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Error;

class ApiException extends \Exception {
    protected $_errors = null;

    public function setErrors(array $data) : void {
        $this->_errors = $data;
    }

    public function getErrors() : array {
        return $this->_errors;
    }

    public function getFirstError() : string
    {
        if (!empty($this->_errors['base'][0])) {
            return $this->_errors['base'][0];
        }

        return $this->_errors;
    }

}
