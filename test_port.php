<?php
echo "Testing port 465 (smtps)... ";
$conn = @fsockopen('ssl://smtp.gmail.com', 465, $errno, $errstr, 10);
if ($conn) { echo "OPEN ✅\n"; fclose($conn); }
else { echo "BLOCKED ❌ - $errstr\n"; }

echo "Testing port 587 (starttls)... ";
$conn2 = @fsockopen('tcp://smtp.gmail.com', 587, $errno, $errstr, 10);
if ($conn2) { echo "OPEN ✅\n"; fclose($conn2); }
else { echo "BLOCKED ❌ - $errstr\n"; }
