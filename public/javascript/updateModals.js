 //Javascript for Modal that updates the Job Details when opened per JObs ID
 function openUpdateModal(id, companyName, jobPosition, platform, status, notes) {
    console.log('Modal opened with data:', id, companyName, jobPosition, platform, status, notes);
    document.getElementById('job_id').value = id;
    document.getElementById('companyName').value = companyName;
    document.getElementById('jobPosition').value = jobPosition;
    document.getElementById('platform').value = platform;
    document.getElementById('status').value = status;
    document.getElementById('notes').value = notes;
    $('#updateStatus').modal('show');

}