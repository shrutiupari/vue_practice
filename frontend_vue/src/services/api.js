import axios from "axios";

export default axios.create({
  baseURL: "http://localhost:8000/api", // Symfony backend
  headers: {
    "Content-Type": "application/json",
  },
});
