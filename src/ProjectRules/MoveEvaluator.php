<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class MoveEvaluator
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
     * @return array<string,array<int|string>|int|string>
     * array<string,array<int,int>|int|string>
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
        $colData = $this->points($cols, $deck, $card);

        /**
         * @var int $maxRowPoints
         */
        $maxRowPoints = $rowData['max'];
        /**
         * @var int $maxColPoints
         */
        $maxColPoints = $colData['max'];
        /**
         * @var int $bestRow;
         */
        $bestRow = $rowData['bestHand'];
        /**
         * @var int $bestCol;
         */
        $bestCol = $colData['bestHand'];
        /**
         * @var array<int,array<string,int|string>> $pointsRows
         */
        $pointsRows = $rowData['points'];
        /**
         * @var array<int,array<string,int|string>> $pointsCols
         */
        $pointsCols = $colData['points'];

        $rowData2 = $this->pointsWithoutCard($rows, $deck);
        $colData2 = $this->pointsWithoutCard($cols, $deck);
        /**
         * @var array<int,array<string,int|string>> $pointsRwithoutCard
         */
        $pointsRwithoutCard = $rowData2['points'];
        /**
         * @var array<int,array<string,int|string>> $pointsCwithoutCard
         */
        $pointsCwithoutCard = $colData2['points'];

        $handRules = $this->extractRuleNames($pointsRows, $pointsCols, $pointsRwithoutCard, $pointsCwithoutCard);

        if ($maxRowPoints >= $maxColPoints) {
            $data = $this->slot($pointsRows, $pointsCols, $bestRow, $rows);
            $data = array_merge($data, $handRules);
            return $data;
        }
        $data = $this->slot($pointsCols, $pointsRows, $bestCol, $cols, true);
        $data = array_merge($data, $handRules);
        return $data;
        // return $this->slot($pointsCols, $pointsRows, $bestCol, $cols, true);
    }
}
