using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.IO;
using System.Configuration;

namespace WebSitePayment
{
    // Đây là trang đón kết quả trả về từ VTC

    public partial class Done : System.Web.UI.Page
    {
        string Security_Key = ConfigurationManager.AppSettings["SecretKey"];  // Neu trên môi trường thật thay thế
        bool isVerify = false;
        string merchantSign = string.Empty;

        protected void Page_Load(object sender, EventArgs e)
        {
            try
            {
                if (Request.HttpMethod.ToUpper() == "POST")
                {
                    // Day la trang nhan ket qua thanh toan duoi hinh thuc POST (Server to Server)                
                    // Doi tac can trien khai trang nhan nay de luon nhan duoc ket qua tra ve tu VTC nham giam cac giao dich phat sinh                
                    ExcuteResultNotifyFromVTCPay();
                }
                else if (Request.HttpMethod.ToUpper() == "GET")
                {
                    ExcuteResultRedirectUrl(); ;
                }
            }
            catch (Exception ex)
            {
                NLogLogger.LogInfo(Request.Url.AbsoluteUri + Environment.NewLine + ex);
            }
        }

        // Xu ly ket qua VTC tra ve Merchant tren url
        private void ExcuteResultRedirectUrl()
        {
            NLogLogger.LogInfo("Ket qua GET:" + HttpContext.Current.Request.Url.AbsoluteUri);

            if (Request.QueryString["reference_number"] == null || Request.QueryString["amount"] == null || Request.QueryString["website_id"] == null)
                return;

            // Lay cac tham so tra ve tren url
            double amount = Convert.ToDouble(Request.QueryString["amount"]);
            string message = Request.QueryString["message"];
            string payment_type = Request.QueryString["payment_type"];
            string reference_number = Request.QueryString["reference_number"];
            int status = Convert.ToInt32(Request.QueryString["status"]);
            string trans_ref_no = Request.QueryString["trans_ref_no"];
            int website_id = Convert.ToInt32(Request.QueryString["website_id"]);
            string signature = Server.HtmlDecode(Request.QueryString["signature"].ToString().Replace(" ", "+"));

            object[] arrParamReturn = new object[] { amount, message, payment_type, reference_number, status, trans_ref_no, website_id };
            string textSign = string.Join("|", arrParamReturn) + "|" + Security_Key;

            merchantSign = Security.SHA256encrypt(textSign);
            isVerify = (merchantSign == signature);

            if (isVerify)
            {
                lblVerify.Text = "Chu ky hop le";
                lblReport.Text = GetStatusMessage(status);
            }
            else
            {
                NLogLogger.LogInfo("HTTP GET.Sai chu ky. Text:" + textSign
                    + Environment.NewLine + "Sign:" + merchantSign);
                lblVerify.Text = "Chu ky sai";
            }
        }

        // Xử lý kết quả từ server VTC POST về trang đón tại server Merchant
        private void ExcuteResultNotifyFromVTCPay()
        {
            // Tiến hành thực hiện update trạng thái cho giao dịch và post tới server merchant.
            string data = Request.Form.Get("data") ?? "";
            string sign = Request.Form.Get("signature") ?? "";
            merchantSign = Security.SHA256encrypt(data + "|" + Security_Key);
            isVerify = (merchantSign == sign);

            if (isVerify)
            {
                // Chữ ký OK, phân tích kết quả của VTC trả về để xử lý tiếp tại hệ thống của Merchant
                // data = amount|message|payment_type|reference_number| status|trans_ref_no|website_id
                if (string.IsNullOrEmpty(data) || data.Split('|').Length != 7)
                    NLogLogger.LogInfo("Du lieu khong hop le. Can check lai:" + data);
                else
                {
                    string[] arrParamReturn = data.Split('|');
                    string amount = arrParamReturn[0];
                    string message = arrParamReturn[1];
                    string payment_type = arrParamReturn[2]; // Hinh thuc thanh toan cua khach hang tai cong VTC Pay (VCB, Visa, Master, vi VTC Pay ...)
                    string reference_number = arrParamReturn[3]; // Ma cua Merchant luc gui don hang
                    string status = arrParamReturn[4]; // Trang thai don hang
                    string trans_ref_no = arrParamReturn[5]; // Ma tham chieu trên hệ thống VTC
                    string website_id = arrParamReturn[6]; //  
                }
            }
            else
            {
                // Sai chữ ký --> Chưa xác định được tính đúng đắn của dữ liệu trả về từ VTC. Cần phối hợp với VTC để check nguyên nhân sai chữ ký
            }

            NLogLogger.LogInfo("Ket qua POST. data: " + data
                + Environment.NewLine + "signature: " + sign
                + Environment.NewLine + "Vefify: " + isVerify);
        }


        private string GetStatusMessage(int status)
        {
            string message = string.Empty;
            switch (status)
            {
                case 1:
                    message = "Giao dịch thành công";
                    break;
                case 0:
                    message = "Giao dịch ở trạng thái khởi tạo";
                    break;
                case -1:
                    message = "Giao dịch thất bại";
                    break;
                case -9:
                    message = "Khách hàng tự hủy giao dịch";
                    break;
                case -3:
                    message = "Quản trị VTC hủy giao dịch";
                    break;
                case -4:
                    message = "Thẻ/tài khoản không đủ điều kiện giao dịch (Đang bị khóa, chưa đăng ký thanh toán online …)";
                    break;
                case -5:
                    message = "Số dư thẻ/tài khoản khách hàng không đủ để thực hiện giao dịch";
                    break;
                case -6:
                    message = "Lỗi giao dịch tại VTC";
                    break;
                case -7:
                    message = "Khách hàng nhập sai thông tin thanh toán ( Sai thông tin tài khoản hoặc sai OTP)";
                    break;
                case -8:
                    message = "Quá hạn mức giao dịch trong ngày";
                    break;
                case -22:
                    message = "Số tiền thanh toán đơn hàng quá nhỏ";
                    break;
                case -24:
                    message = "Đơn vị tiền tệ thanh toán đơn hàng không hợp lệ";
                    break;
                case -25:
                    message = "Tài khoản VTC Pay nhận tiền của Merchant không tồn tại.";
                    break;
                case -28:
                    message = "Thiếu tham số bắt buộc phải có trong một đơn hàng thanh toán online";
                    break;
                case -29:
                    message = "Tham số request không hợp lệ";
                    break;
                case -21:
                    message = "Trùng mã giao dịch, Có thể do xử lý duplicate không tốt nên bị trùng, mạng chậm hoặc khách hàng nhấn F5, hoặc cơ chế sinh mã GD của đối tác không tốt, đối tác cần kiểm tra lại để biết thời gian, số tiền và trạng thái của giao dịch này tại VTC";
                    break;
                case -23:
                    message = "WebsiteID không tồn tại";
                    break;
                case -99:
                    message = "Lỗi chưa rõ nguyên nhân và chưa biết trạng thái giao dịch. Cần kiểm tra để biết giao dịch thành công hay thất bại";
                    break;
                default:
                    message = "Lỗi chưa rõ nguyên nhân và chưa biết trạng thái giao dịch. Cần kiểm tra để biết giao dịch thành công hay thất bại";
                    break;
            }
            return message;
        }



    }
}