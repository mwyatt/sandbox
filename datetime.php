<?php

$content = '<p class="category">1, 223</p>
<p>After an extensive search for a TV cabinet, Fiona finally chose a SCALA. She shares her thoughts with us.</p><p><strong><img style="float: left;" title="SPEC003 | Fiona Band, SCALA SC1650 White" src="/files/marketing/SPEC003_400px.jpg" alt="SPEC003 | Fiona Band, SCALA SC1650 Black" width="400" height="399" />Hi Fiona. Which Spectral Cabinet Do You Own?</strong><br />We own a beautiful SCALA SC1650 lowboard cabinet finished in black with glass side panels. We also had the SCALA further customised with an internal storage drawer.</p><p><strong>When did you purchase your Spectral TV stand?</strong><br />We ordered it on the 1st of June 2012 and took delivery just over a month later.<br /> <br /><strong>What made you choose a Spectral TV stand?</strong><br />The TV stand was the final piece of furniture to complete my living room so I was prepared to take the time to search as widely as possible in order to ensure I made the right choice. When I came across the Spectral Scala I loved it immediately. &nbsp;As soon as I found the SCALA, I can honestly say, I stopped looking!</p><p><strong>What do you like the most about your SCALA?</strong><br />I love the clean lines, the low height, the reflective glass and the fact that all my ancillary TV equipment is hidden. Because the front flap is solid, I also bought a ZU1811 infrared system which allows me to operate the equipment inside the unit (by remote control), without having to open the front door of the unit. This is a super piece of equipment and I would highly recommend it.</p><p><strong>How Did You Find Your Delivery Experience?</strong><br /><span>Delivery was ok - I thought, in view of the price of the unit, that the delivery men would insert the legs of the unit, but they advised they didn\'t do that and the unit was left with me. &nbsp;I managed to do it myself, but it is a very heavy unit, so I think inserting the legs and sliding the unit into place, is something that ought to be considered as standard with delivery.</span></p>';

function newsGetTag($content) {
    if (strpos($content, '<p class="category">') !== false) {
        $categories = substr($content, strpos($content, '<p class="category">'), strpos($content, '</p>'));
        $categories = str_replace('<p class="category">', '', $categories);
        $categories = str_replace('</p>', '', $categories);
        $categories = trim($categories);
        return explode(',', $categories);
    }

    return false;
}

$timestamp = "1357571577";

echo '<pre>';
echo date('jS', $timestamp) . ' of ' . date('F Y', $timestamp);
echo '</pre>';
exit;
