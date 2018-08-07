<?php
/**
 * This is where we store the obstacle algorithm.
 *
 * 1. Turn right, then advance. (TR, A)
 * 2. If that also hits an obstacle: Turn Left, Back, Turn Right, Advance (TL, B, TR, A)
 * 3. If that also hits an obstacle: Turn Left, Turn Left, Advance (TL, TL, A)
 * 4. If that also hits and obstacle: Turn Right, Back, Turn Right, Advance (TR, B, TR, A)
 * 5. If that also hits and obstacle: Turn Left, Turn Left, Advance (TL, TL, A)
 * 6. If an obstacle is hit again the robot will stop and return.
 */
Class Rules {
    private $hits = 1;
    private $ruleList = array(
        '1' => array('TR','A'),
        '2' => array('TL', 'B', 'TR', 'A'),
        '3' => array('TL', 'TL', 'A'),
        '4' => array('TR', 'B', 'TR', 'A'),
        '5' => array('TL', 'TL', 'A'),
        '6' => array('STOP')
    );

    public function getRules() {
        $rule = $this->ruleList[$this->hits];
        $this->hits = $this->hits + 1;
        return $rule;
    }

    public function resetHits() {
        $this->hits = 1;
    }
}
