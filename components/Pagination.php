<?php
/*
 * ����� Pagination ��� ��������� ������������ ���������
 */
class Pagination{
    /**
     * 
     * @var ������ ��������� �� ��������
     * 
     */
    private $max = 10;
    /**
     * 
     * @var ���� ��� GET, � ������� ������� ����� ��������
     * 
     */
    private $index = 'page';
    /**
     * 
     * @var ������� ��������
     * 
     */
    private $current_page;
    /**
     * 
     * @var ����� ���������� �������
     * 
     */
    private $total;
    /**
     * 
     * @var ������� �� ��������
     * 
     */
    private $limit;
    /**
     * ������ ����������� ������ ��� ���������
     * @param type $total <p>����� ���������� �������</p>
     * @param type $currentPage <p>����� ������� ��������</p>
     * @param type $limit <p>���������� ������� �� ��������</p>
     * @param type $index <p>���� ��� url</p>
     */
    public function __construct($total, $currentPage, $limit, $index)
    {
        # ������������� ����� ���������� �������
        $this->total = $total;
        # ������������� ���������� ������� �� ��������
        $this->limit = $limit;
        # ������������� ���� � url
        $this->index = $index;
        # ������������� ���������� �������
        $this->amount = $this->amount();
        
        # ������������� ����� ������� ��������
        $this->setCurrentPage($currentPage);
    }
    /**
     *  ��� ������ ������
     * @return HTML-��� �� �������� ���������
     */
    public function get()
    {
        # ��� ������ ������
        $links = null;
        # �������� ����������� ��� �����
        $limits = $this->limits();
        
        $html = '<ul class="pagination">';
        # ���������� ������
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            # ���� ������� ��� ������� ��������, ������ ��� � ����������� ����� active
            if ($page == $this->current_page) {
                $links .= '<li class="active"><a href="">' . $page . '</a></li>';
            } else {
                # ����� ���������� ������
                $links .= $this->generateHtml($page);
            }
        }
        # ���� ������ ���������
        if (!is_null($links)) {
            # ���� ������� �������� �� ������
            if ($this->current_page > 1)
            # ������ ������ "�� ������"
                $links = $this->generateHtml(1, '&lt;') . $links;
            # ���� ������� �������� �� ������
            if ($this->current_page < $this->amount)
            # ������ ������ "�� ���������"
                $links .= $this->generateHtml($this->amount, '&gt;');
        }
        $html .= $links . '</ul>';
        # ���������� html
        return $html;
    }
    /**
     * ��� ��������� HTML-���� ������
     * @param integer $page - ����� ��������
     * 
     * @return
     */
    private function generateHtml($page, $text = null)
    {
        # ���� ����� ������ �� ������
        if (!$text)
        # ���������, ��� ����� - ����� ��������
            $text = $page;
        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);
        # ��������� HTML ��� ������ � ����������
        return
                '<li><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';
    }
    /**
     *  ��� ���������, ������ ����������
     * 
     * @return ������ � ������� � ������ �������
     */
    private function limits()
    {
        # ��������� ������ ����� (����� �������� ������ ���� ����������)
        $left = $this->current_page - round($this->max / 2);
        
        # ��������� ������ �������
        $start = $left > 0 ? $left : 1;
        # ���� ������� ���� ��� ������� $this->max �������
        if ($start + $this->max <= $this->amount) {
        # ��������� ����� ����� ����� �� $this->max ������� ��� ������ �� �������
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            # ����� - ����� ���������� �������
            $end = $this->amount;
            # ������ - ����� $this->max �� �����
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }
        # ����������
        return
                array($start, $end);
    }
    /**
     * ��� ��������� ������� ��������
     * 
     * @return
     */
    private function setCurrentPage($currentPage)
    {
        # �������� ����� ��������
        $this->current_page = $currentPage;
        # ���� ������� �������� ������ ����
        if ($this->current_page > 0) {
            # ���� ������� �������� ������ ������ ���������� �������
            if ($this->current_page > $this->amount)
            # ������������� �������� �� ���������
                $this->current_page = $this->amount;
        } else
        # ������������� �������� �� ������
            $this->current_page = 1;
    }
    /**
     * ��� ��������� ������ ����� �������
     * 
     * @return ����� �������
     */
    private function amount()
    {
        # ����� � ����������
        return ceil($this->total / $this->limit);
    }
}