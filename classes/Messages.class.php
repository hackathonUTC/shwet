<?php
class Messages {
	private function Messages (){
	}

	public static function debug($message){ ?>
		<div class="alert alert-success" role="alert">
		    <?php echo($message); ?>
		</div>
	<?php }

	public static function info($message){ ?>
		<div class="alert alert-info" role="alert">
		    <?php echo($message); ?>
		</div>
	<?php }

	public static function warn($message){ ?>
		<div class="alert alert-warning" role="alert">
		    <?php echo($message); ?>
		</div>
	<?php }

	public static function error($message){ ?>
		<div class="alert alert-danger" role="alert">
		    <?php echo($message); ?>
		</div>
	<?php }

	public static function future_info($message){
		$_SESSION['messages'] = $_SESSION['messages'].'<div class="alert alert-info" role="alert">'.$message.'</div>';
	}

	public static function future_warn($message){
		$_SESSION['messages'] = $_SESSION['messages'].'<div class="alert alert-warning" role="alert">'.$message.'</div>';
	}

	public static function future_error($message){
		$_SESSION['messages'] = $_SESSION['messages'].'<div class="alert alert-danger" role="alert">'.$message.'</div>';
	}

	public static function echo_future(){
		echo $_SESSION['messages'];
		$_SESSION['messages'] = '';
	}
};