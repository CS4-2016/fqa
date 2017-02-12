function ConfirmDeactivate()
    {
      var x = confirm("Are you sure you want to deactivate?");
      if (x)
          return true;
      else
        return false;
    }