import { Link } from "react-router-dom";
import image from "../../assets/main_logo.png";

const Navbar = () => {
	return (
		<>
			<div className="header">
				<div className="navbar">
					<Link to="/requests">
						<img className="main_logo" src={image} alt="main logo" />
					</Link>
					<div className="header_text">
						<Link to="/requests">
							<div className="page">Requests</div>
						</Link>
						<Link to="/bahan-baku">
							<div className="page">Bahan</div>
						</Link>
						<Link to="/resep ">
							<div className="page">Resep</div>
						</Link>
						<div
							onClick={() => {
								document.cookie =
									"token= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
								window.location.href = "../login";
							}}
							className="account"
						>
							<span className="material-icons" id="account-logo">
								logout
							</span>
						</div>
					</div>
				</div>
			</div>
			<style>
				{`
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
		    @import url("https://fonts.googleapis.com/icon?family=Material+Icons");

        * {
          font-family: Poppins;
        }
        .header {
          display: flex;
          justify-content: center;
        }
        .navbar {
          position: absolute;
          display: flex;
          justify-content: space-between;
          margin: auto;
          align-items: center;
          width: 80%;
          padding-top: 15px;
        }
        .main_logo {
          width: 287px;
        }
        .header_text {
          display: flex;
          justify-content: flex-end;
          align-items: center;
          width: min(50%, 450px);
        }
        .header_text>a {
          text-decoration: none;
        }
        .page {
          margin-right: 30px;
          font-size: 22px;
          line-height: 36px;
          color: #850b42;
		      text-decoration: none;
        }
        .text {
          font-size: 20px;
          line-height: 30px;
          /* identical to box height */
          color: #850b42;
        }
        .account {
          display: flex;
          align-items: center;
          justify-content: center;
        }
        #account-logo {
          font-size: 40px;
          color: #850b42;
          cursor: pointer;
        }
        #expand-logo {
          color: #850b42;
          cursor: pointer;
        }
        .account-expand {
          display: flex;
          position: absolute;
          top: max(100px, 10%);
          right: 5%;
          align-items: center;
          transition: 0.2s;
          opacity: 0;
          visibility: hidden;
        }
        .account-expand.active {
          transition: 0.2s;
          visibility: visible;
          background-color: white;
          opacity: 1;
        }
        .expand-dropdown {
          list-style: none;
          width: 200px;
          z-index: 999;
        }
        .dropdown-item {
          border-style: solid;
          border-width: thin;
          border-color: #850b42;
          background-color: white;
          padding-bottom: 15px;
          padding-top: 15px;
        }
        .dropdown-text {
          padding-left: 6px;
        }
        footer {
          padding: 30px 0;
          background-color: #850b42;
          color: #fff;
          text-align: center;
          font-family: Poppins;
        }
        .logout-btn {
          background-color: transparent;
          background-repeat: no-repeat;
          border: none;
          cursor: pointer;
          overflow: hidden;
          outline: none;
          box-shadow: none;
          -moz-box-shadow: none;
          text-align: left;
          position: absolute;
        }
        .hero-wrapper .logout-btn {
          top: 45px;
        }
        .logout-form {
          height: 30px;
        }
	
        `}
			</style>
		</>
	);
};

export default Navbar;
