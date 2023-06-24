<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
class MoveEvaluator
{
    use EvaluatorTrait;
    use EvaluatorTrait2;

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
        RuleStats2 $stats= new RuleStats2(),
        ColumnGetter $colGetter = new ColumnGetter(),
    ) {
        $this->rules = $stats->getRules();
        $this->finder = $finder;
        $this->finder2 = $finder2;
        $this->colGetter = $colGetter;
    }

    /**
     * @param array<int,array<string,int|string>> $pointsRows
     * @param array<int,array<string,int|string>> $pointsCols
     * @param array<array<string>> $rows
     * @return array<string,array<int,int>|int|string>
     */
    public function slot(array $pointsRows, array $pointsCols, int $bestRow, array $rows, bool $inverted=false): array
    {
        // $slot = $this->finder2->oneCell($this->rows, $this->cols);

        /**
         * @var string $rowRule
         */
        $rowRule = $pointsRows[$bestRow]['rule'];
        $colRule = "";
        $row = [];
        if (array_key_exists($bestRow, $rows)) {
            $row = $rows[$bestRow];
        }
        $emptySlots = $this->finder->single($row, $bestRow);
        $slot = $emptySlots[0];
        $colPoints = 0;

        foreach($emptySlots as $emptySlot) {
            $col = $emptySlot[1];
            /**
             * @var int $pointsCol
             */
            $pointsCol = $pointsCols[$col]['points'];
            if ($pointsCol >= $colPoints) {
                $colPoints = $pointsCol;
                $slot = $emptySlot;
                /**
                 * @var string $colRule
                 */
                $colRule = $pointsCols[$col]['rule'];
            }
        }
        if ($inverted) {
            return [
                'col-rule' => $rowRule,
                'row-rule' => $colRule,
                'slot' => [$slot[1], $slot[0]]
            ];
        }
        return [
            'col-rule' => $colRule,
            'row-rule' => $rowRule,
            'slot' => $slot
        ];
    }

    /**
     * @param array<array<string>> $rows
     * @param array<string> $deck
     * @return array<string,array<int,int>|int|string>
     */
    public function suggestion(array $rows, string $card, array $deck): array
    {
        if ($rows === []) {
            $data = $this->checkForRule([0 => []], 0, $deck, $card);
            /**
             * @var string $rule
             */
            $rule = $data['rule'];
            return [
                'col-rule' => $rule,
                'row-rule' => $rule,
                'slot' => [0, 0]
            ];
        }
        /**
         * @var array<array<string>> $cols
         */
        $cols = $this->colGetter->all($rows);
        // $this->rows = $rows;
        // $this->cols = $cols;

        $rowData = $this->points($rows, $deck, $card);
        $colData = $this->points($cols, $deck, $card);
        $maxRowPoints = $rowData['max'];
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

        if ($maxRowPoints >= $maxColPoints) {
            return $this->slot($pointsRows, $pointsCols, $bestRow, $rows);
        }
        return $this->slot($pointsCols, $pointsRows, $bestCol, $cols, true);
    }
}
