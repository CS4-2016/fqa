function ConfirmRestore()
    {
      var x = confirm("Are you sure you want to restore?");
      if (x)
          return true;
      else
        return false;
    }