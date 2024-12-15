<?php

namespace ResetButton\AparserPhpClient\Enums;

enum ChangeableTaskStatus : string
{
    case STARTING = 'starting';
    case PAUSING = 'pausing';
    case STOPPING = 'stopping';
    case DELETING = 'deleting';
}