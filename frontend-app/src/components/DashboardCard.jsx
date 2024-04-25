import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import {Skeleton} from "@mui/material";

const boxStyle = {
    flexGrow: 1,
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    padding: "24px",
    boxShadow: "0px 9px 7px -2px #d9d9d9",
    borderRadius: '10px',
    marginLeft: '3px',
    marginRight: '3px',
};
export default function DashboardCard({ loading, icon, textDescription, amount }) {
    return (
        <Box sx={ boxStyle }>
            { loading ?
                (
                    <>
                        <Skeleton variant="circular" width={50} height={50} sx={{ marginBottom: '10px' }} />
                        <Skeleton variant="rectangular" width="100%" height={20} sx={{ marginBottom: '10px' }} />
                        <Skeleton variant="rectangular" width="100%" height={20} sx={{ marginBottom: '10px' }} />
                    </>
                ) :
                (
                    <>
                        <Typography sx={{ lineHeight: 1.8 }}>{ icon }</Typography>
                        <Typography sx={{ lineHeight: 1.8, fontSize: 12 }}>{ textDescription }</Typography>
                        <Typography sx={{ lineHeight: 1.8, fontSize: "18px", fontWeight: "bold" }}>{ amount }</Typography>
                    </>
                )
            }
        </Box>
    );
}
