<?php


namespace Wagento\Surveymonkey\Ui\Component;


use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;

class DataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider {

    private $surveys;

    public function __construct
    (
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        \Wagento\Surveymonkey\Helper\Surveys $surveys,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct(
                $name,
                $primaryFieldName,
                $requestFieldName,
                $reporting,
                $searchCriteriaBuilder,
                $request,
                $filterBuilder,
                $meta,
                $data
        );
        $this->surveys = $surveys;
    }

    public function getData()
    {
        if ($sorting = $this->request->getParam('sorting'))
            $surveys = $this->surveys->listSurveys();
        else
            $surveys = $this->surveys->listSurveys();

        $data = array();
        $result = [];
        $data['totalRecords'] = count($surveys);

        $searchCriteria = $this->searchCriteriaBuilder->getData();

        $pageSize = $searchCriteria['page_size'];
        $currentPage = $searchCriteria['current_page'];

        $first = (($pageSize * $currentPage) - $pageSize);

        if (($first + $pageSize) < count($surveys))
            $last = $pageSize * $currentPage;
        else
            $last = count($surveys);

        for ($i = $first; $i < $last; $i++) {
            $survey = $surveys[$i];
            $result[] = $survey;
        }
        $data['items'] = $result;
        return $data;
    }

    /**
     * @param $surveys
     * @param $sorting
     * @return array
     */
    private function getSorting($surveys, $sorting) {
        $arraySorting = array();

        $key = 0;
        foreach ($surveys as $survey) {
            $arraySorting[$survey[$sorting['field']] . $key++] = $survey;
        }

        if ($sorting['direction'] == 'asc')
            ksort($arraySorting);
        else
            ksort($arraySorting);

        return $arraySorting;
    }



}