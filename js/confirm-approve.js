function ConfirmApprove()
    {
      var x = confirm("Are you sure you want to approve?");
      if (x)
          return true;
      else
        return false;
    }