<?php $formattedDate = $context->getDateTime()->format('l, F j'); ?>
<h1 class="day-heading" data-datetime="<?php echo $context->getDateTime()->format('c') ?>">
    <?php echo $formattedDate ?>
    <a class="permalink" href="<?php echo $context->getURL(); ?>"><span class="wdn-icon-link" aria-hidden="true"></span><span class="wdn-text-hidden">permalink</span></a>
    <a href="<?php echo $context->getURL() ?>.ics"><span class="wdn-icon-calendar" aria-hidden="true"></span><span class="wdn-text-hidden">ics format for events on <?php echo $formattedDate ?></span></a>
</h1>
<p class="day-nav">
    <a class="url prev" href="<?php echo $context->getPreviousDay()->getURL(); ?>">Previous Day</a>
    <a class="url next" href="<?php echo $context->getNextDay()->getURL(); ?>">Next Day</a>
</p>
<?php
$events = array(
    'ongoing' => array(),
    'today' => array(),
);
foreach ($context->getRawObject() as $event) {
    if ($event->isOngoing()) {
        $events['ongoing'][] = $event;
    } else {
        $events['today'][] = $event;
    }
}
?>
<?php echo $savvy->render(new ArrayIterator($events['today']), 'EventListing.tpl.php'); ?>
<?php if (!empty($events['ongoing'])): ?>
<h2 class="ongoing-heading">Ongoing Events</h2>
<?php echo $savvy->render(new ArrayIterator($events['ongoing']), 'EventListing.tpl.php'); ?>
<?php endif; ?>
