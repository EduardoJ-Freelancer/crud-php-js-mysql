<?php require_once "Database.php";

class Tasks extends Database
{

	 /**
     * Retorna una cadena formateada en filas de tabla de HTML
     *
     * @return array
     */
	public function list(): string
	{
		$query = "SELECT * FROM tasks ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
		$tr = "";
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$id = $row['id'];
			$task_name = $row['task_name'];
			$created_at = $row['created_at'];
			$tr .="<tr><td>$id</td><td>$task_name</td><td>$created_at</td>";				  
			$tr .= '<td><div class="d-grid gap-2 d-md-block">
						<a href="edit.php?id='.$id.'" class="btn btn-outline-primary btn-sm edit-task">
							<i class="bi bi-pencil-square"></i>
						</a>
						<button type="button" id="'.$id.'" class="btn btn-outline-danger btn-sm delete-task">
							<i class="bi bi-trash"></i>
						</button>
					</div></td>';
		}
		if( $stmt->rowCount() == 0 ) {
			$tr .= "<tr><td class='text-center text-danger' colspan='4'>Sin registros.</td></tr>";
		}
		return $tr;
	}	
	
	/**
     * Crea un nuevo registro. 
	 * Espera como parámetro una cadena: nombre de tarea task_name.
     *
     * @return string
     */
	public function insert( string $task ): string
	{
		$query = "INSERT INTO tasks(task_name) VALUES(?) ";
		$stmt = $this->connect()->prepare($query);
		if( $stmt->execute([$task]) ){
			return "success";
		}
	}

	/**
     * Retorna un registro por id
     *
     * @param int|string $id
     *
     * @return array|null
     */
	public function get_row( $id ): array|null
	{
		$query = "SELECT * FROM tasks WHERE id = ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$id]);
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			return $row;		
		}
		return NULL;
	}

	/**
     * Actualizar registro.
     *
     * @param int|string $id
     *
     * @return string
     */
	public function update( string $task, int $id ): string
	{
		$query = "UPDATE tasks SET task_name = ? where id = ? ";
		$stmt = $this->connect()->prepare($query);
		if( $stmt->execute([$task, $id]) ) {
			return "success";
		}
	}

	/**
     * Busca y retorna una cadena formateada en filas de tabla de HTML de los registros coincidentes
     *
	 * @param int|string $id
	 * 
     * @return array
     */
	public function search( int|string $keywords ): string
	{
		$keywords_lower = strtolower( $keywords ); 
		$query = "SELECT * FROM tasks WHERE task_name LIKE ? OR id LIKE ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$keywords_lower, $keywords_lower]);
		$tr = "";
		while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			$id = $row['id'];
			$task_name = $row['task_name'];
			$created_at = $row['created_at'];
			$tr .="<tr><td>$id</td><td>$task_name</td><td>$created_at</td>";				  
			$tr .= '<td><div class="d-grid gap-2 d-md-block">
						<a href="edit.php?id='.$id.'" class="btn btn-outline-primary btn-sm edit-task">
							<i class="bi bi-pencil-square"></i>
						</a>
						<button type="button" id="'.$id.'" class="btn btn-outline-danger btn-sm delete-task">
							<i class="bi bi-trash"></i>
						</button>
					</div></td>';
		}
		if( $stmt->rowCount() == 0 ) {
			$tr .= "<tr><td class='text-center text-danger' colspan='4'>Sin registros.</td></tr>";
		}
		return $tr;
	}

	/**
     * Elimina un registro.
     *
     * @param int|string $id
     *
     * @return string
     */
	public function delete( int|string $id ): string
	{
		$query = "DELETE FROM tasks WHERE id = ?";
		$stmt = $this->connect()->prepare($query);
		if( $stmt->execute([$id]) ) {
			return "1 registro eliminado.";
		}
	}

}