use Tests\TestCase;

class JobHelperTest extends TestCase
{
    public function testWillExpireAt()
    {
        // You can add your test cases here to validate the behavior of the 'willExpireAt' function

        // Example 1: Test for a due time that is less than or equal to 90 hours
        $dueTime = now()->addHours(50);
        $createdAt = now();
        $result = JobHelper::willExpireAt($dueTime, $createdAt);
        $this->assertEquals($dueTime->format('Y-m-d H:i:s'), $result);

        // Example 2: Test for a due time that is less than or equal to 24 hours
        $dueTime = now()->addHours(20);
        $createdAt = now()->subHours(20);
        $result = JobHelper::willExpireAt($dueTime, $createdAt);
        $this->assertEquals($createdAt->addMinutes(90)->format('Y-m-d H:i:s'), $result);

        // Example 3: Test for a due time that is more than 24 hours but less than or equal to 72 hours
        $dueTime = now()->addHours(60);
        $createdAt = now()->subHours(60);
        $result = JobHelper::willExpireAt($dueTime, $createdAt);
        $this->assertEquals($createdAt->addHours(16)->format('Y-m-d H:i:s'), $result);

        // Example 4: Test for a due time that is more than 72 hours
        $dueTime = now()->addDays(4);
        $createdAt = now();
        $result = JobHelper::willExpireAt($dueTime, $createdAt);
        $this->assertEquals($dueTime->subHours(48)->format('Y-m-d H:i:s'), $result);
    }
}
