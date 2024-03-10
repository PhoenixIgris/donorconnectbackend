<?php

namespace App\Enums;

class Status
{
    const UNVERIFIED = 'unverified';
    const VERIFIED = "verified";
    const REQUESTED = "requested";
    const PENDING_REQUEST = "pending_request";
    const RECEIVED = "received";
    const CLOSED = "closed";
}
