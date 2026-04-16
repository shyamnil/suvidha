<?php
session_start();
// 1. SESSION SECURITY
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUVIDHA - Election Permission Portal</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <style>
        :root {
            --primary-color: #1a73e8;
            --secondary-color: #34a853;
            --bg-color: #f8f9fa;
            --text-color: #202124;
            --border-color: #dadce0;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            background: white;
            max-width: 900px;
            width: 100%;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
        }

        h1 {
            color: var(--primary-color);
            text-align: center;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            margin-top: 0;
        }

        .pdf-upload-box {
            border: 2px dashed var(--primary-color);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            text-align: center;
            background: #e8f0fe;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin: 20px 0 10px 0;
            color: #5f6368;
            text-transform: uppercase;
            border-left: 4px solid var(--primary-color);
            padding-left: 10px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        label { display: block; font-weight: 600; margin-bottom: 5px; font-size: 14px; }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1.5px solid var(--border-color);
            border-radius: 6px;
            box-sizing: border-box;
        }

        #rally_fields, #p1_fields { display: none; margin-top: 15px; padding: 15px; border-radius: 8px; }
        #rally_fields { background: #f1f3f4; border-left: 5px solid var(--primary-color); }
        #p1_fields { background: #fff4e5; border-left: 5px solid #ffa000; }

        .gen-btn {
            width: 100%;
            background-color: var(--secondary-color);
            color: white;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
        }

        #preview-section { display: none; margin-top: 20px; }
        iframe { width: 100%; height: 800px; border: 1px solid var(--border-color); border-radius: 8px; }
        
        @media (max-width: 600px) { .grid { grid-template-columns: 1fr; } }
		.site-footer {
        margin-top: 30px;
        padding: 15px;
        text-align: center;
        border-top: 1px solid #dadce0;
    }

    .shyam-credit {
        color: #1a73e8;
        font-weight: bold;
        text-decoration: none;
    }
    </style>
</head>
<body>

<div class="container">
    <div id="form-section">
        <h1>Suvidha Permission Portal</h1>

        <div class="pdf-upload-box">
            <strong>Auto-Fill from ENCORE PDF</strong><br>
            <input type="file" id="pdf-file" accept="application/pdf" style="margin-top:10px;">
            <p id="status" style="font-size:12px; margin-top:5px; color:var(--primary-color);"></p>
        </div>

        <form id="permission-form" onsubmit="generateAndPreview(event)">
            
            <div class="section-title">Form Configuration</div>
            <div class="grid">
                <div>
                    <label>Permission Type:</label>
                    <select name="form_type" id="form_type" onchange="toggleType()">
                        <option value="annexure_l">Annexure-L (Loudspeaker)</option>
                        <option value="annexure_p1">Annexure-P1 (Street Corner Meeting)</option>
                        <option value="annexure_p3">Annexure-P3 (Rally/Procession)</option>
						<option value="door">Annexure-P3 (Door to Door Canvasing)</option>
						<option value="annexure_p5">Annexure-P5 (Display Poster/ Hoarding)</option>
						<option value="annexure_n1">Annexure-N1 (Street/ Holding Meeting)</option>
						<option value="annexure_n10">Annexure-N10 (Holding Procession/Rally)</option>
                    </select>
                </div>
                <div>
                    <label>Permission No:</label>
                    <input type="text" name="per_id" placeholder="Ex: 123456">
                </div>
                <div>
                    <label>Permission Date:</label>
                    <input type="date" name="per_date">
                </div>
				<div>
                    <label>AC Name:</label>
                    <input type="text" name="ac_name" id="ac_name_input">
                </div>
            </div>

            <div class="section-title">Application Details</div>
            <div class="grid">
                <div>
                    <label>Application ID:</label>
                    <input type="text" name="app_id" id="app_id" required>
                </div>
                <div>
                    <label>Application Date:</label>
                    <input type="date" name="app_date" id="app_date" required>
                </div>
                <div>
                    <label>Application Time:</label>
                    <input type="time" name="app_time" id="app_time" required>
                </div>
                <div>
                    <label>Party Name:</label>
                    <input type="text" name="party" id="party">
                </div>
                <div>
                    <label>Applicant Name:</label>
					<input type="text" name="applicant_name" id="applicant_name_select">
                </div>
                <div>
                    <label>Candidate Name:</label>
                    <input type="text" name="candidate_name" id="candidate_name_input">
                </div>
				<div>
                    <label>Police Station:</label>
                    <input type="text" name="police_station" id="police_station">
                </div>
				<div>
                    <label>Block Name:</label>
                    <input type="text" name="block" id="block">
                </div>
				
            </div>

            <div class="section-title">Event Details</div>
            <div class="grid">
                <div>
                    <label>Event Start Date:</label>
                    <input type="date" name="events_date" id="events_date">
                </div>
				<div>
                    <label>Event End Date:</label>
                    <input type="date" name="evente_date" id="evente_date">
                </div>
                <div>
                    <label>Start Time:</label>
                    <input type="time" name="evts_time" id="evts_time">
                </div>
                <div>
                    <label>End Time:</label>
                    <input type="time" name="end_time" id="end_time">
                </div>
                <div>
                    <label>Place/Location:</label>
                    <input type="text" name="place" id="place">
                </div>
				
            </div>

            <div id="p1_fields">
                <label>Venue Name:</label>
                <input type="text" name="venue" id="venue" placeholder="Ex: Town Hall Ground">
            </div>

            <div id="rally_fields">
                <label>Rally Route:</label>
                <input type="text" name="route" id="route" placeholder="Full route details">
                <div class="grid" style="margin-top:10px;">
                    <div>
                        <label>Flags Count:</label>
                        <input type="number" name="flags" value="0">
                    </div>
                    <div>
                        <label>Stickers Count:</label>
                        <input type="number" name="stickers" value="0">
                    </div>
                </div>
            </div>
			<div id="p5_fields">
                <label>Mouza Name:</label>
                <input type="text" name="mouza" id="mouza" placeholder="Ex: Nadanghat">
				<label>Plot No:</label>
                <input type="text" name="plot" id="plot" placeholder="Ex: 408">
            </div>


            <button type="submit" class="gen-btn" id="submit-btn">Generate & View PDF</button>
        </form>
    </div>

    <div id="preview-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <h3 style="margin:0; color:var(--primary-color);">PDF Preview</h3>
            <button type="button" onclick="goBack()" style="background:#70757a; color:white; border:none; padding:8px 15px; border-radius:5px; cursor:pointer;">&larr; Back to Form</button>
        </div>
        <iframe id="pdf-frame"></iframe>
    </div>
	<footer class="site-footer">
    <p class="footer-text">
        SUVIDHA AUTOMATION SYSTEM &copy; 2026 | 
        <span class="shyam-credit">Created By Mr. Shyam Sundar Modak</span>
    </p>
</footer>
</div>

<script>
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

// --- DATA EXTRACTION ---
document.getElementById('pdf-file').addEventListener('change', async function(e) {
    const file = e.target.files[0];
    if (!file) return;
    document.getElementById('status').innerText = "Extracting...";
    
    const reader = new FileReader();
    reader.onload = async function() {
        const typedarray = new Uint8Array(this.result);
        const pdf = await pdfjsLib.getDocument(typedarray).promise;
        let text = "";
        for (let i = 1; i <= pdf.numPages; i++) {
            const page = await pdf.getPage(i);
            const content = await page.getTextContent();
            text += content.items.map(item => item.str).join(" ");
        }

        const nameMatch = text.match(/Name:\s*([\s\S]*?)(?=Address|$)/i);
        if (nameMatch) {
            const val = nameMatch[1].trim();
            document.getElementById('applicant_name_select').value = val;
        }

        const partyMatch = text.match(/Party Name:\s*([\s\S]*?)(?=State|$)/i);
        if (partyMatch) document.getElementById('party').value = partyMatch[1].trim();
		
		// Extract AC Name
			const acMatch = text.match(/AC:\s*([\s\S]*?)(?=Police Station|$)/i);
				if (acMatch) document.getElementById('ac_name_input').value = acMatch[1].trim();
				
			// 3. Extract Police Station (Look for Rampurhat) 
		// We use \s* to catch the value even if it's on a new line in the text stream
			const psMatch = text.match(/Police Station\s*([\s\S]*?)(?=Location|$)/i);
			if (psMatch) document.getElementById('police_station').value = psMatch[1].trim();
		
        const refMatch = text.match(/Refrence ID:\s*([A-Z0-9]+)/i);
        if (refMatch) document.getElementById('app_id').value = refMatch[1];

        const locMatch = text.match(/Location:\s*([\s\S]*?)(?=Submission|$)/i);
        if (locMatch) {
            const cleanLoc = locMatch[1].replace(/\s+/g, ' ').trim();
            document.getElementById('place').value = cleanLoc;
            document.getElementById('route').value = cleanLoc;
            document.getElementById('venue').value = cleanLoc;
        }

        const subMatch = text.match(/Submission Date & Timing\s*(\d{2}-\d{2}-\d{4})\s*(\d{2}:\d{2}:\d{2}[a-z]{2})/i);
        if (subMatch) {
            document.getElementById('app_date').value = subMatch[1].split('-').reverse().join('-');
            document.getElementById('app_time').value = convertTo24Hour(subMatch[2]);
        }

        const evtMatch = text.match(/Date\s*&\s*Timing:\s*(\d{2}-\d{2}-\d{4})\s+\d{2}:\d{2}:\d{2}[ap]m\s+to\s+(\d{2}-\d{2}-\d{4})/i);

			if (evtMatch) {
							document.getElementById('events_date').value = evtMatch[1].split('-').reverse().join('-');
							document.getElementById('evente_date').value = evtMatch[2].split('-').reverse().join('-');
}
        const allTimes = text.match(/(\d{2}:\d{2}:\d{2})(am|pm)/gi);
        if (allTimes && allTimes.length >= 2) {
            document.getElementById('evts_time').value = convertTo24Hour(allTimes[allTimes.length - 2]);
            document.getElementById('end_time').value = convertTo24Hour(allTimes[allTimes.length - 1]);
        }
        document.getElementById('status').innerText = "Auto-filled!";
    };
    reader.readAsArrayBuffer(file);
});

function convertTo24Hour(timeStr) {
    let [time, modifier] = [timeStr.substring(0,8), timeStr.substring(8).toLowerCase()];
    let [hours, minutes] = time.split(':');
    if (hours === '12') hours = '00';
    if (modifier === 'pm') hours = parseInt(hours, 10) + 12;
    return `${hours.toString().padStart(2, '0')}:${minutes}`;
}

// --- NAVIGATION & TYPE TOGGLE ---
async function generateAndPreview(e) {
    e.preventDefault();
    const btn = document.getElementById('submit-btn');
    btn.innerText = "Generating...";
    btn.disabled = true;

    const formData = new FormData(e.target);
    const response = await fetch('generate_pdf.php', { method: 'POST', body: formData });
    const blob = await response.blob();
    
    document.getElementById('pdf-frame').src = URL.createObjectURL(blob);
    document.getElementById('form-section').style.display = 'none';
    document.getElementById('preview-section').style.display = 'block';
    window.scrollTo(0,0);
}

function goBack() {
    document.getElementById('preview-section').style.display = 'none';
    document.getElementById('form-section').style.display = 'block';
    document.getElementById('submit-btn').innerText = "Generate & View PDF";
    document.getElementById('submit-btn').disabled = false;
}

function toggleType() {
    const val = document.getElementById('form_type').value;
    document.getElementById('rally_fields').style.display = (val === 'annexure_p3') ? 'block' : 'none';
    document.getElementById('p1_fields').style.display = (val === 'annexure_p1') ? 'block' : 'none';
	document.getElementById('p5_fields').style.display = (val === 'annexure_p5') ? 'block' : 'none';
}
</script>
</body>
</html>