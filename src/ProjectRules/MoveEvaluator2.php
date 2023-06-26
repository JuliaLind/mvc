<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class MoveEvaluator2
{
    use EvaluatorTrait;
    use EvaluatorTrait2;
    use EvaluatorTrait3;
    use EvaluatorTrait4;
    use EvaluatorTrait5;
    use EvaluatorTrait6;

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

        $pointsRows = [];
        $pointsCols = [];
        // because most diff (points with card - points without card) equals to
        // 0 - 100 (lowest score with card and highest wihtout card)
        $maxRowPoints = -100;
        $maxColPoints = -100;
        $bestRow = 0;
        $bestCol = 0;

        for ($i=0; $i <= 4; $i++) {
            /**
             * @var int $pointsRowWithCard
             */
            $pointsRowWithCard = $pointsRowsWithCard[$i]['points'];
            /**
             * @var int $pointsRowWithoutCard
             */
            $pointsRowWithoutCard = $pointsRwithoutCard[$i]['points'];
            /**
             * @var int $pointsColWithCard
             */
            $pointsColWithCard = $pointsColsWithCard[$i]['points'];
            /**
             * @var int $pointsColWithoutCard
             */
            $pointsColWithoutCard = $pointsCwithoutCard[$i]['points'];

            $rowDiff = $pointsRowWithCard - $pointsRowWithoutCard;
            $colDiff = $pointsColWithCard - $pointsColWithoutCard;
            $rowRuleWithCard = $pointsRowsWithCard[$i]['rule'];
            $rowRuleWithoutCard = $pointsRwithoutCard[$i]['rule'];
            $colRuleWithCard = $pointsColsWithCard[$i]['rule'];
            $colRuleWithoutCard = $pointsCwithoutCard[$i]['rule'];
            $pointsRows[$i] = [
                'row-rule-with-card' => $rowRuleWithCard,
                'row-rule-without-card' => $rowRuleWithoutCard,
                'points' => $rowDiff
            ];
            if ($rowDiff >= $maxRowPoints) {
                $maxRowPoints = $rowDiff;
                $bestRow = $i;
            }
            $pointsCols[$i] = [
                'col-rule-with-card' => $colRuleWithCard,
                'col-rule-without-card' => $colRuleWithoutCard,
                'points' => $colDiff
            ];
            if ($colDiff >= $maxColPoints) {
                $maxColPoints = $colDiff;
                $bestCol = $i;
            }
        }

        $handRules = $this->extractRuleNames($pointsRows, $pointsCols, $pointsRwithoutCard, $pointsCwithoutCard);

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
