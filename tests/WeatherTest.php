<?php

use Mockery\Adapter\Phpunit\MockeryTestCase;

class WeatherTest extends MockeryTestCase
{
    public function testWeather()
    {
        $service = $this->createMock(\Src\TemperatureService::class);

        $map = [
            ['12:00' , 20],
            ['14:00' , 26],
        ];

        $service->expects($this->exactly(2))
                ->method('getTemperature')
                ->will($this->returnValueMap($map));


        $weather = new \Src\WeatherMonitor($service);

        $this->assertEquals(23,$weather->getAverageTemperature('12:00','14:00'));
    }
    public function testWeatherWithMockery()
    {
        $service = Mockery::mock(\Src\TemperatureService::class);

        $service->shouldReceive('getTemperature')
            ->once()->with('12:00')->andReturn(20);

        $service->shouldReceive('getTemperature')
            ->once()->with('14:00')->andReturn(26);


        $weather = new \Src\WeatherMonitor($service);

        $this->assertEquals(23,$weather->getAverageTemperature('12:00','14:00'));
    }


}
