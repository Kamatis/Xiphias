<html>
		<head>
			<title>Resume</title>
			<style>
				.table-resume {
					border-collapse: collapse;
					table-layout: fixed;
				}
				.resume-td {
					width=380px;
					word-wrap: break-word;
					text-align: center;
				}

				.resume-td-bold {
					font-weight: bold;
					font-size: 24px;
				}

				.resume-td-normal {
					font-size: 15px;
				}

				.resume-p-head {
					font-size: 13px;
					line-height: 0.5;
					font-weight: bold;
				}

				.resume-p-body {
					font-size: 13px;
					line-height: 0.5;
					text-indent: 25px;
				}

				.resume-table-500 {
					border-collapse: collapse;
					table-layout: fixed;
					width: 100%;
					border: 1px solid black;
					margin-left: 0px;
				}

				.resume-th {
					border: solid 1px black;
					word-wrap: break-word;
					text-align: center;
					font-weight: bold;
				}
					
				.resume-th-40p {
					width: 40%;	
				}
					
				.resume-th-50p {
					width: 50%;	
				}
					
				.resume-th-20p {
					width: 20%;
				}
					
				.resume-th-25p {
					width: 25%;
				}
					
				.resume-th-35p {
					width: 35%;		
				}
					
				.resume-th-15p {
					width: 15%;		
				}

				.resume-td {
					border: solid 1px black;
					word-wrap: break-word;
					text-align: center;
				}
					
				.resume-td-brless {
					border: 0px;		
				}
					
				.resume-td-40p {
					width: 40%;		
				}
					
				.resume-td-50p {
					width: 50%;		
				}
					
				.resume-td-20p {
					width: 20%;		
				}
					
				.resume-td-35p {
					width: 35%;		
				}
					
				.resume-td-15p {
					width: 15%;		
				}
					
				.resume-th-25p {
					width: 25%;
				}
					
				.resume-td-235 {
					border: solid 1px black;
					width: 235px;
					word-wrap: break-word;
					text-align: center;
					font-weight: bold;
				}

				.resume-td-school-inc-year-header {
					border: solid 1px black;
					width: 20%;
					word-wrap: break-word;
					text-align: center;
					font-weight: bold;
				}	
			</style>
		</head>
		<body>
			<table class="table-resume">
				<tr>
						<td class="resume-td-brless resume-td-bold"><?php echo $fullname; ?></td>
				</tr>
				<tr>
						<td  class="resume-td-brless resume-td-normal"><?php echo $address; ?></td>
				</tr>
				<tr>
						<td class="resume-td-brless resume-td-normal"><?php echo $contact; ?></td>
				</tr>
				<tr>
						<td class="resume-td-brless resume-td-normal"><?php echo $emailadd; ?></td>
				</tr>
		</table><hr>
		<p class="resume-p-head">Career Objective</p>
		<p class="resume-p-body"><?php echo $objective; ?></p>
		<p class="resume-p-head">Educational Background</p>
		<div width="100%">
				<table class="resume-table-500">
						<tr>
								<td class="resume-th resume-th-40p">School Attended</td>
								<td class="resume-th resume-th-40p">Degree Attained</td>
								<td class="resume-th resume-th-20p">Inclusive Years</td>
						</tr>
						<tr>
								<td class="resume-td resume-td-40p" >Ateneo de Naga University</td>
								<td class="resume-td resume-td-40p" >Bachelor of Science in Information Technology</td>
								<td class="resume-td resume-td-20p">2012 - 2016</td>
						</tr>
						<tr>
								<td class="resume-td resume-td-40p" >Ateneo de Naga University - High School</td>
								<td class="resume-td resume-td-40p" >High School Diploma</td>
								<td class="resume-td resume-td-20p">2008 - 2012</td>
						</tr>
						<tr>
								<td class="resume-td resume-td-40p" >Naga Central School I</td>
								<td class="resume-td resume-td-40p" >Elementary Diploma</td>
								<td class="resume-td resume-td-20p">2002 - 2008</td>
						</tr>
				</table>
		</div> <br>
		<p class="resume-p-head">Achievements and Accomplishments</p> <br>
		<div>
		<table class="resume-table-500">
				<tr>
						<td class="resume-th resume-th-35p">School/Organization</td>
						<td class="resume-th resume-th-35p">Event</td>
						<td class="resume-th resume-th-15p">Award</td>
						<td class="resume-th resume-th-15p">Date</td>
				</tr>
				<tr>
						<td class="resume-td resume-td-35p">Association of Computing Machineries</td>
						<td class="resume-td resume-td-35p">Inter-Collegiate Programming Competition (Nationals)</td>
						<td class="resume-td resume-td-15p">37th Place</td>
						<td class="resume-td resume-td-15p">February 26, 2013</td>
				</tr>
		</table>
		</div>
		<p class="resume-p-head">Trainings, Seminars and Conferences</p> <br>
		<table class="resume-table-500">
				<tr>
						<td class="resume-th resume-th-35p">Title</td>
						<td class="resume-th resume-th-40p">Place</td>
						<td class="resume-th resume-th-25p">Inclusive Dates</td>
				</tr>
				<?php for($x = 0; $x < count($involvement); $x++) {?>
				<tr>
						<td class="resume-td resume-td-35p"><?php echo $involvement[$x]['name']; ?></td>
						<td class="resume-td resume-td-40p"><?php echo $involvement[$x]['venue']; ?></td>
						<td class="resume-td resume-td-25p"><?php echo $involvement[$x]['start_date'] . " - " . $involvement[$x]['end_date']; ?></td>
				</tr>
				<?php } ?>
		</table>
		<br>
		<!--<page>-->
		<p class="resume-p-head">Organizational Affiliations</p>
		<br>
		<table class="resume-table-500">
				<tr>
						<td class="resume-th resume-th-50p">Organization</td>
						<td class="resume-th resume-th-25p">Position</td>
						<td class="resume-th resume-th-25p">Inclusive Dates</td>
				</tr>
				<?php for($x = 0; $x < count($affiliations); $x++) {?>
				<tr>
						<td class="resume-td resume-td-50p"><?php echo $affiliations[$x]['organization']; ?></td>
						<td class="resume-td resume-td-25p"><?php echo $affiliations[$x]['position']; ?></td>
						<td class="resume-td resume-td-25p"><?php echo $affiliations[$x]['start_date'] . " - " . $affiliations[$x]['end_date']; ?></td>
				</tr>
				<?php } ?>
		</table> <br>
				
		<page>
		<p style="font-size: 13px; line-height: 0.5; font-weight: bold;">Reference</p>
		<table style="margin-left: 25px;">
				<tr>
						<td style="font-weight: bold;">Dr. Allan A. Sioson</td>
				</tr>
				<tr>
						<td>Dean, College of Computer Studies</td>
				</tr>
				<tr>
						<td>Ateneo de Naga University</td>
				</tr>
		</table><br>
		<table style="margin-left: 25px;">
				<tr>
						<td style="font-weight: bold;">Mr. Joshua C. Martinez</td>
				</tr>
				<tr>
						<td>Faculty, Department of Computer Science</td>
				</tr>
				<tr>
						<td>Ateneo de Naga University</td>
				</tr>
		</table><br>
		<table style="margin-left: 25px;">
				<tr>
						<td style="font-weight: bold;">Mr. Paul Angelo Silvestre</td>
				</tr>
				<tr>
						<td>Faculty, Department of Computer Science</td>
				</tr>
				<tr>
						<td>Ateneo de Naga University</td>
				</tr>
		</table>
		</page>
		</body>
</html>

