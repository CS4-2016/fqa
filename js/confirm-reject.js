function ConfirmReject()
    {
      var x = confirm("Are you sure you want to reject?");
      if (x)
          return true;
      else
        return false;
    }