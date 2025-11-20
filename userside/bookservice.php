<?php
include "userparts/link.php";
include "userparts/header.php";
?>

<section id="book-service" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">

      <div class="col-md-6 col-sm-6">
        <div class="about-info">
          <div class="section-title">
            <h2>Book a Service</h2>
            <span class="line-bar">...</span>
          </div>
          <p>Fill in the details below to book a service for your vehicle. Choose the issue you’re experiencing or specify another problem.</p>
        </div>
      </div>

      <div class="col-md-6 col-sm-6">
        <!-- Message Box -->
        <div id="messageBox1" style=" position: fixed;
  top: 20px;
  right: 20px; z-index:10000;"></div>

        <form id="bookServiceForm" method="POST">
          <div class="form-group">
            <label>Vehicle Model</label>
            <input type="text" name="vehicle_model" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Plate Number</label>
            <input type="text" name="plate_number" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Problem with the Car</label>
            <select name="problem" id="problemSelect" class="form-control" required>
              <option value="">Select Problem</option>
              <option value="Engine Overheating">Engine Overheating</option>
              <option value="Brake Issues">Brake Issues</option>
              <option value="Battery Problem">Battery Problem</option>
              <option value="Flat Tire">Flat Tire</option>
              <option value="Aircon Not Cooling">Aircon Not Cooling</option>
              <option value="Oil Leak">Oil Leak</option>
              <option value="Others">Others</option>
            </select>
          </div>

          <div class="form-group" id="otherProblemField" style="display:none;">
            <label>Please specify the issue</label>
            <input type="text" name="other_problem" class="form-control">
          </div>

          <div class="form-group">
            <label>Additional Details (Optional)</label>
            <textarea name="details" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>When will you deliver your car?</label>
            <input type="date" name="delivery_date" id="deliveryDate" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary btn-block">Submit Service Request</button>
        </form>
      </div>

    </div>
  </div>
</section>


<?php
include "userparts/footer.php";
?>
