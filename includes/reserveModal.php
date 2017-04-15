<div id="reserveModal" class="modal fade">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close modalClose" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Varaa aika</h3>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<form action="jeccu/reserveTime.php" id="modalForm" method="post">
						<input type="hidden" name="varausID" id="varausID">
						<label for="viesti">Viesti: </label>
						<textarea class="form-control noresize" rows="5" id="viesti" name="viesti"></textarea>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" form="modalForm" class="btn btn-primary btn-block reserveButton">Varaa aika</button>
			</div>
		</div>
	</div>	
</div>