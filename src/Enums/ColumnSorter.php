<?php

namespace FmTod\LaravelTabulator\Enums;

enum ColumnSorter: string
{
    case String = 'String';
    case Numeric = 'Numeric';
    case Alphanumeric = 'Alphanumeric';
    case Boolean = 'Boolean';
    case FieldExists = 'Field Exists';
    case Date = 'Date';
    case Time = 'Time';
    case DateTime = 'Date Time';
    case Array = 'Array';
}