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

function getColorSet(count, cPalette = "default") {
  const palette = {
    default: [
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
    ],
    cold: [
      "#7400b8",
      "#6930c3",
      "#5e60ce",
      "#5390d9",
      "#4ea8de",
      "#48bfe3",
      "#56cfe1",
      "#64dfdf",
      "#72efdd",
      "#80ffdb",
    ],

  };
  const colors = palette[cPalette];

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
