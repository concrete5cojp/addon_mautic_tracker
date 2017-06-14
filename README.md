# concrete5 Add-on: Mautic Tracker

Add Mautic JS tracking code to every page. Easy access to custom parameters programmatically.

### How to add custom parameter

You can set custom parameter from your pacakge, or custom codes.

```
$tracker = \Core::make(Concrete\Package\MauticTracker\Mautic\Tracker::class);
$tracker->setParam('email', 'my@email.com');
$tracker->setParam('firstname', 'John');
```

Result:

```
mt('send', 'pageview', {email: 'my@email.com', firstname: 'John'});
```
