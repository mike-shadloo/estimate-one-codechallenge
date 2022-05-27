<?php


class MyMatch{

    protected $_matchName;
    protected $_firstPerson;
    protected $_secondPerson;

    protected $_scorep1;
    protected $_scorep2;
    protected $_game1;
    protected $_game1Total;
    protected $_game2;
    protected $_game2Total;
    protected $_set1;
    protected $_set2;

    protected $_scoreTable=array();
    public function __construct($matchName,$p1,$p2)
    {
        $this->_matchName=$matchName;
        $this->_firstPerson=$p1;
        $this->_secondPerson=$p2;
        $this->_resetGame();
        $this->_game1Total=0;
        $this->_game2Total=0;
        $this->_set1=0;
        $this->_set2=0;
        $this->_resetScore();

    }
    private function _resetGame(){
        $this->_game1=0;

        $this->_game2=0;

    }

    private function _resetScore(){
        $this->_scorep1=0;
        $this->_scorep2=0;
    }

    private function _valueToAdd($score){
        $result=15;//default is 15 meaning if it is 0 ->15 if 15->30
        if($score==30){
            $result=10;
        }elseif($score==40){
            $result=5;
        }elseif($score>40){
            $result=1; //like AD
        }

        return $result;
    }

    /**
     * @param int $toPerson if 0 it add to first person if it is 1 it add to second person
     * if total score of someone is more than 45 and difference is more than 5 it will be a game
     *
     */
    public function addScore(float $toPerson=0){
        switch ($toPerson){
            case 0:
//                echo 'at1';
                $this->_scorep1+=$this->_valueToAdd($this->_scorep1);
//                $this->_addScore($this->_scorep1);
                break;
            case 1:
//                echo 'at2 '.$this->_scorep2;
                $this->_scorep2 +=$this->_valueToAdd($this->_scorep2);
//                $this->_addScore($this->_scorep2);
                break;
        }

        if($this->_checkGameCondition($this->_scorep1,$this->_scorep2)==1){

            ++$this->_game1;
            ++$this->_game1Total;
            $this->_resetScore();
            array_push($this->_scoreTable,'Game for '.$this->_firstPerson);
//            echo 'game for   '.$this->_game1.'+'.$this->_game2;
        }if($this->_checkGameCondition($this->_scorep1,$this->_scorep2)==2){
            array_push($this->_scoreTable,'Game ');
            ++$this->_game2;
            ++$this->_game2Total;
            $this->_resetScore();
            array_push($this->_scoreTable,'Game for '.$this->_secondPerson);
//            echo 'game for   '.$this->_game1.'+'.$this->_game2;


        }

        $this->_checkSetCondition();




        array_push($this->_scoreTable,$this->getScorep1().' : '.$this->getScorep2());

    }
    private function _checkSetCondition(){
        if($this->_game1==6){
            $this->_resetGame();
            $this->_resetScore();
            ++$this->_set1;
            array_push($this->_scoreTable,'set for user1('.$this->_firstPerson.') '.$this->_set1.":".$this->_set2);
        }elseif($this->_game2==6){
            $this->_resetGame();
            $this->_resetScore();
            ++$this->_set2;
            array_push($this->_scoreTable,'set for user2('.$this->_secondPerson.') '.$this->_set1.":".$this->_set2);
        }

    }



    private function _checkGameCondition($score1,$score2){
        $result=3;//by default condition is not saisfied
        if(($score1==45 || $score2==45) && (abs($score1-$score2)>5)){
            $result=($score1==45?1:2);
        }
        if(($score1>45 || $score2>45) && (abs($score1-$score2)==2)){
            $result=(($score1>$score2)?1:2);
        }


        return $result;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return ' score match '.$this->_matchName.' between '.$this->_firstPerson.' and '.$this->_secondPerson
            . PHP_EOL. ' sets '.$this->_set1.' vs '.$this->_set2.PHP_EOL.
            PHP_EOL.' total game '.$this->_game1Total.':'.$this->_game2Total;
    }

    /**
     * @return mixed
     */
    public function getMatchName()
    {
        return $this->_matchName;
    }

    /**
     * @param mixed $matchName
     */
    public function setMatchName($matchName): void
    {
        $this->_matchName = $matchName;
    }

    /**
     * @return mixed
     */
    public function getFirstPerson()
    {
        return $this->_firstPerson;
    }

    /**
     * @param mixed $firstPerson
     */
    public function setFirstPerson($firstPerson): void
    {
        $this->_firstPerson = $firstPerson;
    }

    /**
     * @return mixed
     */
    public function getSecondPerson()
    {
        return $this->_secondPerson;
    }

    /**
     * @param mixed $secondPerson
     */
    public function setSecondPerson($secondPerson): void
    {
        $this->_secondPerson = $secondPerson;
    }

    /**
     * @return mixed
     */
    public function getScorep1()
    {
        return $this->_scorep1;
    }

    /**
     * @param mixed $scorep1
     */
    public function setScorep1($scorep1): void
    {
        $this->_scorep1 = $scorep1;
    }

    /**
     * @return mixed
     */
    public function getScorep2()
    {
        return $this->_scorep2;
    }

    /**
     * @param mixed $scorep2
     */
    public function setScorep2($scorep2): void
    {
        $this->_scorep2 = $scorep2;
    }

    /**
     * @return int
     */
    public function getgame1(): int
    {
        return $this->_game1;
    }

    /**
     * @param int $game1
     */
    public function setgame1(int $game1): void
    {
        $this->_game1 = $game1;
    }

    /**
     * @return int
     */
    public function getgame2(): int
    {
        return $this->_game2;
    }

    /**
     * @param int $game2
     */
    public function setgame2(int $game2): void
    {
        $this->_game2 = $game2;
    }

    /**
     * @return mixed
     */
    public function getScoreTable()
    {
        return $this->_scoreTable;
    }

    /**
     * @param mixed $scoreTable
     */
    public function setScoreTable($scoreTable): void
    {
        $this->_scoreTable = $scoreTable;
    }


}

echo '----------start '.date('Y-m-d H:i:s').'----------'.PHP_EOL;

$fh = fopen('full_tournament.txt','r');
$myMatch=null;
$lineNumber=1;
$result=array();
while ($line = fgets($fh)) {
    //    echo($line);
    if(strpos($line,'Match')!==false){
        if($myMatch!=null) {
            array_push($result, $myMatch . '' . PHP_EOL);
        }
        $myMatch= new MyMatch(trim($line),null,null);
     }
    if(strpos($line,'vs')!==false){
        $arr=explode('vs',$line);
        $myMatch->setFirstPerson(trim($arr[0]));
        $myMatch->setSecondPerson(trim($arr[1]));
    }
    if((trim($line)=='0' || trim($line)=='1')){
    $myMatch->addScore(intval($line));
    }

}
array_push($result,$myMatch.''.PHP_EOL);

print_r($result);

fclose($fh);

echo '----------end----------'.PHP_EOL;

?>

