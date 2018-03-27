<?php
App::import('Helper', 'Paginator');

class BootstrapPaginatorHelper extends PaginatorHelper {

    protected function _extractOption ($key, $options, $default = null) {
        if (isset($options[$key])) {
            return $options[$key] ;
        }
        return $default ;
    }
    
    /**
     * 
     * Get link to the first pagination page.
     * 
     * @param $title The link text
     * @param $options Options for link
     * @param $disabledtitle Title when link is disabled
     * @param $disabledOptions Options for link when it's disabled
     * 
    **/
    public function first ($title = '<<', $options = array(), $disabledTitle = null, $disabledOptions = array()) {
        $options = array_merge(array('tag' => 'li'), $options) ;
        $disabledOptions = array_merge(array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'),
            $disabledOptions) ;
        return parent::first($title, $options, $disabledTitle, $disabledOptions) ;        
    }
    
    /**
     * 
     * Get link to the previous pagination page.
     * 
     * @param $title The link text
     * @param $options Options for link
     * @param $disabledtitle Title when link is disabled
     * @param $disabledOptions Options for link when it's disabled
     * 
    **/
    public function prev ($title = '<', $options = array(), $disabledTitle = null, $disabledOptions = array()) {
        $options = array_merge(array('tag' => 'li'), $options) ;
        $disabledOptions = array_merge(array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'),
            $disabledOptions) ;
        return parent::prev($title, $options, $disabledTitle, $disabledOptions) ;        
    }
    
    /**
     * 
     * Get link to the next pagination page.
     * 
     * @param $title The link text
     * @param $options Options for link
     * @param $disabledtitle Title when link is disabled
     * @param $disabledOptions Options for link when it's disabled
     * 
    **/
    public function next ($title = '>', $options = array(), $disabledTitle = null, $disabledOptions = array()) {
        $options = array_merge(array('tag' => 'li'), $options) ;
        $disabledOptions = array_merge(array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'),
            $disabledOptions) ;
        return parent::next($title, $options, $disabledTitle, $disabledOptions) ;        
    }
    
    /**
     * 
     * Get link to the last pagination page.
     * 
     * @param $title The link text
     * @param $options Options for link
     * @param $disabledtitle Title when link is disabled
     * @param $disabledOptions Options for link when it's disabled
     * 
    **/
    public function last ($title = '>>', $options = array(), $disabledTitle = null, $disabledOptions = array()) {
        $options = array_merge(array('tag' => 'li'), $options) ;
        $disabledOptions = array_merge(array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'),
            $disabledOptions) ;
        return parent::last($title, $options, $disabledTitle, $disabledOptions) ;        
    }
    
        
/**
 * Returns a set of numbers for the paged result set
 * uses a modulus to decide how many numbers to show on each side of the current page (default: 8).
 *
 * `$this->Paginator->numbers(array('first' => 2, 'last' => 2));`
 *
 * Using the first and last options you can create links to the beginning and end of the page set.
 *
 * ### Options
 *
 * - `before` Content to be inserted before the numbers
 * - `after` Content to be inserted after the numbers
 * - `model` Model to create numbers for, defaults to PaginatorHelper::defaultModel()
 * - `modulus` how many numbers to include on either side of the current page, defaults to 8.
 * - `separator` Separator content defaults to ' | '
 * - `tag` The tag to wrap links in, defaults to 'span'
 * - `first` Whether you want first links generated, set to an integer to define the number of 'first'
 *    links to generate. If a string is set a link to the first page will be generated with the value
 *    as the title.
 * - `last` Whether you want last links generated, set to an integer to define the number of 'last'
 *    links to generate. If a string is set a link to the last page will be generated with the value
 *    as the title.
 * - `ellipsis` Ellipsis content, defaults to '...'
 * - `class` Class for wrapper tag
 * - `currentClass` Class for wrapper tag on current active page, defaults to 'current'
 * - `currentTag` Tag to use for current page number, defaults to null
 *
 * @param array|bool $options Options for the numbers, (before, after, model, modulus, separator)
 * @return string Numbers string.
 * @link https://book.cakephp.org/2.0/en/core-libraries/helpers/paginator.html#PaginatorHelper::numbers
 */
	public function numbers($options = array()) {
		if ($options === true) {
			$options = array(
				'before' => ' | ', 'after' => ' | ', 'first' => 'first', 'last' => 'last'
			);
		}

		$defaults = array(
			'tag' => 'li', 'before' => null, 'after' => null, 'model' => $this->defaultModel(), 'class' => null,
			'modulus' => '8', 'separator' => ' | ', 'first' => null, 'last' => null, 'ellipsis' => '...',
			'currentClass' => 'current', 'currentTag' => null
		);
		$options += $defaults;

		$params = (array)$this->params($options['model']) + array('page' => 1);
		unset($options['model']);

		if (empty($params['pageCount']) || $params['pageCount'] <= 1) {
			return '';
		}

		extract($options);
		unset($options['tag'], $options['before'], $options['after'], $options['model'],
			$options['modulus'], $options['separator'], $options['first'], $options['last'],
			$options['ellipsis'], $options['class'], $options['currentClass'], $options['currentTag']
		);
		$out = '';

                $backpage = ($params['page']>1 ? ($params['page'] - 1):1);
                $nextpage = ($params['pageCount']>$params['page'] ? ($params['page'] + 1):$params['pageCount']);

		if ($modulus && $params['pageCount'] > $modulus) {
			$half = (int)($modulus / 2);
			$end = $params['page'] + $half;

			if ($end > $params['pageCount']) {
				$end = $params['pageCount'];
			}
			$start = $params['page'] - ($modulus - ($end - $params['page']));
			if ($start <= 1) {
				$start = 1;
				$end = $params['page'] + ($modulus - $params['page']) + 1;
			}

                        $out .= $this->Html->tag($tag, $this->link('<<', array('page' => $backpage), ['class' => 'page-link']), ['class' => 'page-item'.($backpage!=$params['page'] ? '':' disabled')]);
                        
			for ($i = $start; $i < $params['page']; $i++) {
                                $out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), ['class' => 'page-link']), ['class' => 'page-item']);
			}

                        $out .= $this->Html->tag($tag, $this->link($params['page'], array('page' => $params['page']), ['class' => 'page-link']), ['class' => 'page-item']);

			$start = $params['page'] + 1;
			for ($i = $start; $i < $end; $i++) {
				$out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), ['class' => 'page-link']), ['class' => 'page-item']);
			}

                        $out .= $this->Html->tag($tag, $this->link('>>', array('page' => $nextpage), ['class' => 'page-link']), ['class' => 'page-item'.($nextpage!=$params['page'] ? '':' disabled')]);
		} else {
			$out .= $before;

                        $out .= $this->Html->tag($tag, $this->link('<<', array('page' => $backpage), ['class' => 'page-link']), ['class' => 'page-item'.($backpage!=$params['page'] ? '':' disabled')]);
                        
			for ($i = 1; $i <= $params['pageCount']; $i++) {
				if ($i == $params['page']) {
                                    $out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), ['class' => 'page-link']), ['class' => 'page-item active']);
				} else {
                                    $out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), ['class' => 'page-link']), ['class' => 'page-item']);
				}
			}

                        $out .= $this->Html->tag($tag, $this->link('>>', array('page' => $nextpage), ['class' => 'page-link']), ['class' => 'page-item'.($nextpage!=$params['page'] ? '':' disabled')]);
                        
			$out .= $after;
		}

		return $out;
	}

}

?>
