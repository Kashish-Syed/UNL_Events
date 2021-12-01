<?php
namespace UNL\UCBCN\Frontend;

use UNL\UCBCN\ActiveRecord\RecordList;

class EventListing extends RecordList
{
    /**
     * Calendar \UNL\UCBCN\Frontend\Calendar Object
     *
     * @var \UNL\UCBCN\Frontend\Calendar
     */
    public $calendar;

    /**
     * Constructor for an individual day.
     *
     * @param array $options Associative array of options to apply.
     */
    public function __construct($options)
    {
        if (!isset($options['calendar'])) {
            throw new InvalidArgumentException('A calendar must be set', 500);
        }

        $this->calendar = $options['calendar'];

        parent::__construct($options);
    }
    
    public function getDefaultOptions()
    {
        return array(
            'listClass' => __CLASS__,
            'itemClass' => __NAMESPACE__ . '\\EventInstance',
        );
    }

    public function current()
    {
        try {
            if (\LimitIterator::valid()) {
                $options = $this->options + \LimitIterator::current();
                return new $this->options['itemClass']($options);
            }
        } catch (Exception $e) {
            // Exception thrown with current item so skip and process next item
            \LimitIterator::next();
            return $this->current();
        }
    }
}