<?php
const SUPERIOR = 1;
const INFERIOR = -1;

class NumberFinder
{
    public int $guessMin;
    public int $guessMax;

    public int $guess;

    public function __construct(public int $min, public int $max)
    {
        $this->guessMin = $this->min;
        $this->guessMax = $this->max;
    }

    public function buildGuess($compare = null) : int
    {
        switch($compare) {
            case SUPERIOR :
                $this->guessMin = $this->guess + 1;
            break;
            case INFERIOR :
                $this->guessMax = $this->guess - 1;
        }
        $this->guess = round(($this->guessMax + $this->guessMin)/2, PHP_ROUND_HALF_UP);

        return $this->guess;
    }
}

function printUsage()
{
    global $argv;
    ?>
    This is a command line PHP script.
    It will find a number (numberToFind) between a minimum (minNumber) and a maximum (maxNumber) with a maximum (maxTries or maxNumber) guesses.
    You need to pass to it 4 args.

    Usage:
    <?php echo $argv[0]; ?> minNumber maxNumber maxTries numberToFind
    <?php
}

function checkUsage()
{
    global $argc;
    return $argc == 5;
}

if(!checkUsage()){
    printUsage();
    exit;
}
$min = intval($argv[1]);
$max = intval($argv[2]);
$maxGuesses = intval($argv[3]);
$numberToFind = intval($argv[4]);

$start = microtime(true);
$finder = new NumberFinder($min, $max);
$guess = $finder->buildGuess();
$tries = 1;
echo "first guess : $guess".PHP_EOL;
while($guess != $numberToFind && $tries < min($maxGuesses,$max)) {
    $tries++;
    if($numberToFind > $guess) {
        $compare = SUPERIOR;
    } else {
        $compare = INFERIOR;
    }

    echo "no, it's ".($compare==SUPERIOR?"superior":"inferior").PHP_EOL;
    $guess = $finder->buildGuess($compare);
    echo "ok, new guess : $guess".PHP_EOL;
}
$end = microtime(true);
if($guess == $numberToFind) {
    echo 'You found it !!!!'.PHP_EOL;
    echo "in $tries guesses".PHP_EOL;
} else {
    echo "Sorry, I'm bored, you're too long : $tries guesses is enough : you lose".PHP_EOL;
}
echo "Duration : ".(($end - $start)*1000000)." microseconds".PHP_EOL;
