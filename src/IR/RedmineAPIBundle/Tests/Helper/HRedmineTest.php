<?php
namespace IR\RedmineAPIBundle\Tests\Helper;

class HRedmineTest extends \PHPUnit_Framework_TestCase
{
    public function testUkr_rusToTranslit()
    {
        $hrMock = $this->getMockBuilder('IR\RedmineAPIBundle\Helper\HRedmine')
            ->disableOriginalConstructor()
            ->getMock();
        $hrMock->expects($this->once())
            ->method('getProjects')
            ->will($this->returnValue(1));

        $this->assertEquals(1, $hrMock->getProjects());
    }
}