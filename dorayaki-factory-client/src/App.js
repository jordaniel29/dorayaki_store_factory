import React from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";

import Login from "./pages/Login/Login";
import Register from "./pages/Register/Register";
import Resep from "./pages/Resep/Resep";
import BahanBaku from "./pages/BahanBaku/BahanBaku";
import Requests from "./pages/Requests/Requests";
import Navbar from "./components/global/Navbar";
import ProtectedRoute from "./components/protectedroute/ProtectedRoute";
import PublicRoute from "./components/protectedroute/PublicRoute";

function App() {
	return (
		<BrowserRouter>
			<Navbar />
			<Routes>
				<Route
					path="/login"
					element={
						<PublicRoute>
							<Login />
						</PublicRoute>
					}
				/>
				<Route
					path="/register"
					element={
						<PublicRoute>
							<Register />
						</PublicRoute>
					}
				/>
				<Route
					path="/requests"
					element={
						<ProtectedRoute>
							<Requests />
						</ProtectedRoute>
					}
				/>
				<Route
					path="/resep"
					element={
						<ProtectedRoute>
							<Resep />
						</ProtectedRoute>
					}
				/>
				<Route
					path="/bahan-baku"
					element={
						<ProtectedRoute>
							<BahanBaku />
						</ProtectedRoute>
					}
				/>
			</Routes>
		</BrowserRouter>
	);
}

export default App;
