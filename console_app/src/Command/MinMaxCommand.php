<?php

namespace App\Command;



use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class MinMaxCommand extends Command
{
// the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:min-max';


    protected function configure()
    {
        $this->addArgument('length', InputArgument::REQUIRED,'Length of array');

    }

    /**
     * This method is checking for length of array,
     * if we have a length lower tha 2 that means our array
     * have just 1 element, in that case we can not find max and min
     * of array.
     *
     * @param int $length
     * @param OutputInterface $output
     * @return int|void
     */
    private function checkValidLengthValue(int $length, OutputInterface $output){
        return ($length < 2) ? die('Your parameter must be greater or equal 2') : $length;
        // Dizinin en az olmasi gereken elemanlarin sayisi 2dir
    }

    /**
     * We define our array and after fill with 0 as length elements, we refill all elements
     * with random ones from min to max
     * @param int $length
     * @param int $min
     * @param int $max
     * @return array|false
     */
    private function getRandomArrayOfElements(int $length, int $min, int $max) : array{
        $array = array_fill(0,$length,'value');
        return $array ? array_map(function ($element) use ($min,$max){
            return $element = rand($min, $max);
        },$array): false;
    }


    /**
     * Find maximum number of an array.
     * @param array $array
     * @return int
     */
    private function getMax(array $array):int{
        $max = $array[0];
        for($i=1;$i<count($array)-1;$i++){
            if($max < $array[$i]){
                $max = $array[$i];
            }
        }
        return $max;
    }

    /**
     * Find minimum number of an array.
     * @param array $array
     * @return int
     */
    private function getMin(array $array):int{
        $min = $array[0];
        for($i=1;$i<count($array)-1;$i++){
            if($min > $array[$i]){
                $min = $array[$i];
            }
        }
        return $min;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {


        $length = $this->checkValidLengthValue($input->getArgument('length')+0, $output);
        $defineArray = $this->getRandomArrayOfElements($length,1,1000);

        $output->writeln('Array = { '.implode(", ",$defineArray).' }');
        $output->writeln('Min = '.$this->getMin($defineArray));
        $output->writeln('Max = '.$this->getMax($defineArray));


        return Command::SUCCESS;


    }
}