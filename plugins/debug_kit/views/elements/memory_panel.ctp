<?php
/* SVN FILE: $Id$ */
/**
 * Session Panel Element
 *
 * 
 *
 * PHP versions 4 and 5
 *
 * CakePHP :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2006-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2006-2008, Cake Software Foundation, Inc.
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP Project
 * @package       cake
 * @subpackage    cake.debug_kit.views.elements
 * @since         
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<h2><?php __('Memory'); ?></h2>
<p class="current-mem-use"><strong><?php __('Current Memory Use'); ?>:</strong> <?php echo $number->toReadableSize(DebugKitDebugger::getMemoryUse()); ?></p>
<p class="peak-mem-use"><strong><?php __('Peak Memory Use'); ?>:</strong> <?php echo $number->toReadableSize(DebugKitDebugger::getPeakMemoryUse()); ?></p>