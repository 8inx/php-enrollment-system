function formatDate(date) {
  const monthNames = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ];

  if (!date) return "";
  const d = new Date(date);
  return monthNames[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
}

function getColorSet(count) {
  const colors = [
    "#d946ef",
    "#0ea5e9",
    "#fbbf24",
    "#475569",
    "#10b981",
    "#14b8a6",
    "#3b82f6",
    "#f43f5e",
    "#22d3ee",
    "#fb923c",
    "#a3e635",
    "#4ade80",
  ];

  let stacks = [];
  let index = 0;
  for (let i = 0; i < count; i++) {
    if (index >= colors.length) {
      index = 0;
    }
    stacks.push(colors[index]);
    index++;
  }
  return stacks;
}
