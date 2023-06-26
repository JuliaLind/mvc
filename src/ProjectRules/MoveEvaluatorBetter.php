<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class MoveEvaluatorBetter
{
    use EvaluatorTrait;
    use EvaluatorTrait2;
    use EvaluatorTrait3;
    use EvaluatorTrait4;
    use EvaluatorTrait5;
    use EvaluatorTrait6;
    use EvaluatorTrait7;

    /**
     * @var array<array<string>> $cols
     */
    protected array $cols;
    /**
     * @var array<array<string>> $rows
     */
    protected array $rows;

    protected EmptyCellFinder2 $finder2;


    /**
     * @var array<array<string,string|RuleStatInterface|int>>
     */
    private array $rules;
    private EmptyCellFinder $finder;
    private ColumnGetter $colGetter;

    public function __construct(
        EmptyCellFinder $finder = new EmptyCellFinder(),
        EmptyCellFinder2 $finder2 = new EmptyCellFinder2(),
        RuleStats $stats= new RuleStats(),
        ColumnGetter $colGetter = new ColumnGetter(),
    ) {
        $this->rules = $stats->getRules();
        $this->finder = $finder;
        $this->finder2 = $finder2;
        $this->colGetter = $colGetter;
    }

    /**
     * @param array<array<string>> $hands
     * @param array<int,array<string,int|string>> $pointsWithCard
     * @param array<int,array<string,int|string>> $pointsWithoutCard
     * @return array<string,mixed>
     */
    private function bestHand(array $hands, array $pointsWithCard, array $pointsWithoutCard): array
    {
        $pointsHands = [];
        $currentMax = -100;
        $bestHand = 0;
        for ($i=0; $i <= 4; $i++) {
            /**
             * @var int $pointsHwithCard
             */
            $pointsHwithCard = $pointsWithCard[$i]['points'];
            /**
             * @var int $pointsHwithoutCard
             */
            $pointsHwithoutCard = $pointsWithoutCard[$i]['points'];


            $diff = $pointsHwithCard - $pointsHwithoutCard;
            $ruleWithCard = $pointsWithCard[$i]['rule'];
            $ruleWithoutCard = $pointsWithoutCard[$i]['rule'];
            $pointsHands[$i] = [
                'rule' => $ruleWithCard,
                'rule-without-card' => $ruleWithoutCard,
                'points' => $diff
            ];
            if ($diff >= $currentMax && array_key_exists($i, $hands) && count($hands[$i]) < 5) {
                $currentMax = $diff;
                $bestHand = $i;
            }
        }
        return [
            'points-hands' => $pointsHands,
            'max-points' => $currentMax,
            'best-hand' => $bestHand
        ];
    }


    /**
     * @param array<array<string>> $rows
     * @param array<string> $deck
     * @return array<string,array<int,int|string>|int|string>
     */
    public function suggestion(array $rows, string $card, array $deck): array
    {
        if ($rows === []) {
            return $this->emptyGridSuggestion($deck, $card);
        }
        /**
         * @var array<array<string>> $cols
         */
        $cols = $this->colGetter->all($rows);


        $rowData = $this->points($rows, $deck, $card);
        $rowData2 = $this->pointsWithoutCard($rows, $deck);
        $colData = $this->points($cols, $deck, $card);
        $colData2 = $this->pointsWithoutCard($cols, $deck);
        /**
         * @var array<int,array<string,int|string>> $pointsRowsWithCard
         */
        $pointsRowsWithCard = $rowData['points'];
        /**
         * @var array<int,array<string,int|string>> $pointsColsWithCard
         */
        $pointsColsWithCard = $colData['points'];
        /**
         * @var array<int,array<string,int|string>> $pointsRwithoutCard
         */
        $pointsRwithoutCard = $rowData2['points'];
        /**
         * @var array<int,array<string,int|string>> $pointsCwithoutCard
         */
        $pointsCwithoutCard = $colData2['points'];
        $dataRows = $this->bestHand($rows, $pointsRowsWithCard, $pointsRwithoutCard);
        $dataCols = $this->bestHand($cols, $pointsColsWithCard, $pointsCwithoutCard);
        /**
         * @var array<int,array<string,int|string>> $pointsRows
         */
        $pointsRows = $dataRows['points-hands'];
        /**
         * @var int $maxRowPoints
         */
        $maxRowPoints = $dataRows['max-points'];
        /**
         * @var int $bestRow
         */
        $bestRow = $dataRows['best-hand'];
        /**
         * @var array<int,array<string,int|string>> $pointsCols
         */
        $pointsCols = $dataCols['points-hands'];
        /**
         * @var int $maxColPoints
         */
        $maxColPoints = $dataCols['max-points'];
        /**
         * @var int $bestCol
         */
        $bestCol = $dataCols['best-hand'];

        $handRules = $this->extractRuleNames($pointsRowsWithCard, $pointsColsWithCard, $pointsRwithoutCard, $pointsCwithoutCard);

        if ($maxRowPoints >= $maxColPoints) {
            $data = $this->slot($pointsRows, $pointsCols, $bestRow, $rows);
            $data = array_merge($data, $handRules);
            return $data;
            // return $this->slot($pointsRows, $pointsCols, $bestRow, $rows);
        }
        $data = $this->slot($pointsCols, $pointsRows, $bestCol, $cols, true);
        $data = array_merge($data, $handRules);
        return $data;
        // return $this->slot($pointsCols, $pointsRows, $bestCol, $cols, true);
    }
}
