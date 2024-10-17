function useStock(itemId, amount) {
    const stockElement = document.getElementById(itemId);
    let stock = parseInt(stockElement.innerText);
  
    if (stock >= amount) {
      stock -= amount;
      stockElement.innerText = stock;
  
      // Update replenishment status
      updateReplenishment(itemId, stock);
    } else {
      alert('Not enough stock!');
    }
  }
  
  function updateReplenishment(itemId, stock) {
    let replenishElement;
    switch (itemId) {
      case 'food-stock':
        replenishElement = document.getElementById('food-replenish');
        replenishElement.innerText = stock < 50 ? 'Low Stock' : 'OK';
        break;
      case 'cleaning-stock':
        replenishElement = document.getElementById('cleaning-replenish');
        replenishElement.innerText = stock < 20 ? 'Low Stock' : 'OK';
        break;
      case 'equipment-stock':
        replenishElement = document.getElementById('equipment-replenish');
        replenishElement.innerText = stock < 10 ? 'Low Stock' : 'OK';
        break;
    }
  }

  